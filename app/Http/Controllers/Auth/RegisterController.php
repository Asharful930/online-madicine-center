<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use App\Seller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:sellers');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showSellerRegisterForm()
    {
        return view('auth.register', ['url' => 'seller']);
    }

    protected function createAdmin(Request $request)
    {

        $this->validate($request,[
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $admins = Admin::all();
        if(count($admins) == 0){
            $admin = Admin::create([
                'f_name' => $request['f_name'],
                'l_name' => $request['l_name'],
                'email' => $request['email'],
                'contact' => $request['contact'],
                'password' => Hash::make($request['password']),
                'is_active' => true
            ]);
            return redirect()->intended('/admin/login');
        } else{
            $admin = Admin::create([
                'f_name' => $request['f_name'],
                'l_name' => $request['l_name'],
                'email' => $request['email'],
                'contact' => $request['contact'],
                'password' => Hash::make($request['password'])
            ]);
            return redirect()->intended('/admin/login');
        }
        
        
    }
    protected function createSeller(Request $request)
    {
        $this->validate($request,[
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:255'],
            'tin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sellers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $seller = Seller::create([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'nid' => $request['nid'],
            'tin' => $request['tin'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('seller/login');
    }
}
