<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    // Show the 2FA setup form
    public function showSetupForm(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');
        $secretKey = $request->session()->get('google2fa_secret');
        $QR_Image = $google2fa->getQRCodeInline(config('app.name'), auth()->user()->email, $secretKey);
        
        return view('google2fa.setup', compact('QR_Image', 'secretKey'));
    }

    // Handle the 2FA setup
    public function setup(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');
        $secretKey = $google2fa->generateSecretKey();
        $request->session()->put('google2fa_secret', $secretKey);
        $QR_Image = $google2fa->getQRCodeInline(config('app.name'), auth()->user()->email, $secretKey);
        
        return view('google2fa.setup', compact('QR_Image', 'secretKey'));
    }
}