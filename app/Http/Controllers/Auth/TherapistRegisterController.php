<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Role;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class TherapistRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show the registration form
    public function showTherapistRegistrationForm()
    {
        return view('auth.register_therapist');
    }
    
    // Validate the registration data
    protected function validatorTherapist(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string',
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
            }],
            'gender' => ['required', 'string'],
            'certification' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,docx', 'max:5120'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],

            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'department' => ['required', 'string'],
            'education' => ['required', 'string'],
            
        ]);
    }

    // Create a new user
    protected function createTherapist(array $data)
    {
        // Fetch the role with name 'doctor'
        $role = Role::where('name', 'doctor')->first();

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id, // Ensure role ID is correctly assigned
            'gender' => $data['gender'],
            'status' => 'pending_approval',
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],

            'description' => $data['description'],
            'department' => $data['department'],
            'education' => $data['education'],
        ]);

        // Store the profile picture and update the user record
        if (isset($data['image'])) {
            $filePath = $data['image'];
            $user->image = $filePath;
            $user->save();
        }
    
        // Store the certification file and update the user record
        // dd($data['certification']);
        if (isset($data['certification'])) {
            $filePath = $data['certification'];
            $user->certification = $filePath;
            $user->save();
        }

        return $user;
    }

    // Handle registration request
    public function registerTherapist(Request $request)
    {
        // Validate the request data
        // dd($request->all());
        $this->validatorTherapist($request->all())->validate();

        // Get all request data
        $registration_data = $request->all();
        
        // Store the profile picture if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images', 'public');
            $registration_data['image'] = $filePath;
        }

        // Store the certification file if present
        if ($request->hasFile('certification')) {
            $file = $request->file('certification');
            $filePath = $file->store('certifications', 'public');
            $registration_data['certification'] = $filePath;
        }
        
        // // Handle two-factor authentication if enabled (this part can be skipped if not using 2FA)
        // $google2fa = app('pragmarx.google2fa');
        // $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        $request->session()->put('registration_data', $registration_data);

        $request = $this->createTherapist($registration_data);

        // Redirect to approval required page after registration
        return view('auth.approval_required');
    }

    // Complete the therapist registration
    public function completeTherapistRegistration(Request $request)
    {
        // Retrieve registration data from the session
        $registration_data = $request->session()->get('registration_data');

        if (!$registration_data) {
            return redirect()->route('register.therapist')->with('error', 'Registration data not found in session.');
        }

        // Validate the registration data
        $this->validatorTherapist($registration_data)->validate();

        // Create the user with the registration data
        $user = $this->createTherapist($registration_data);

        // Redirect to the approval required view
        return view('auth.approval_required');
    }
    
}