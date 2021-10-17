<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
class ResetPasswordController extends Controller
{
    
    use ResetsPasswords;
    public function showResetForm(Request $request, $token = null)
    {
          return view('adminAuth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('admins');
    }

    //returns authentication guard of admin
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
