<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile(User $user)
    { 
       return view('user.profile',compact('user'));
    }
    public function editUser(User $user){
        return view('user.profileUpdate',compact('user'));
    }
    public function updateUser(Request $request, User $user)
    {
      
        $this->validate($request,[
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'password' => [ 'string', 'max:255','nullable'],
            'contact' => ['required'],
        ]);
       $user->update([
            'f_name' => $request['f_name'], 
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'contact' => $request['contact'],
        ]);
        if($request->password != null){
            $user->password = Hash::make($request['password']);
            $user->save();
        }
       return redirect()->route('user.profile',$user->id)->with('status','user Updated successfully!');
    }
}
