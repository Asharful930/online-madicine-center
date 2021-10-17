<?php
namespace App\Http\Controllers\SellerAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
//Password Broker Facade
use Illuminate\Support\Facades\Password;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function showResetForm(Request $request, $token = null)
    {
        return view('sellerAuth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('sellers');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('sellers');
    }
}
