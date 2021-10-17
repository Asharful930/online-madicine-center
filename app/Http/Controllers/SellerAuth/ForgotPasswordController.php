<?php

namespace App\Http\Controllers\SellerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('sellerAuth.password.email');
    }
    
    public function broker()
    {
         return Password::broker('sellers');
    }
}
