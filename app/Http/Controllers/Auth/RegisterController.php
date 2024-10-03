<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    use RegistersUsers {
          register as registration;
      }

    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required',
            'string',
            'confirmed',
            function ($attribute, $value, $fail) {
                if (!preg_match('/[a-z]/', $value)) {
                    $fail('The '.$attribute.' must include at least one lowercase letter.');
                }
                if (!preg_match('/[A-Z]/', $value)) {
                    $fail('The '.$attribute.' must include at least one uppercase letter.');
                }
                if (!preg_match('/[0-9]/', $value)) {
                    $fail('The '.$attribute.' must include at least one digit.');
                }
                if (!preg_match('/[\W_]/', $value)) {
                    $fail('The '.$attribute.' must include at least one special character.');
                }
                if (strlen($value) < 8) {
                    $fail('The '.$attribute.' must be at least 8 characters.');
                }
            }
        ],
            
            'gender' => ['required']
        ]);
    }

    protected function create(array $data)
    {
        $role = Role::where('name', 'patient')->first();
        // dd($role);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id, 
            'gender' => $data['gender'],
            'google2fa_secret' => $data['google2fa_secret'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
  
        $google2fa = app('pragmarx.google2fa');
  
        $registration_data = $request->all();
  
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
  
        
        $request->session()->flash('registration_data', $registration_data);
  
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );
          
        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
    }

    public function completeRegistration(Request $request)
    {        
        // add the session data back to the request input
        $request->merge(session('registration_data'));

        // Call the default laravel authentication
        return $this->registration($request);
    } 
}
