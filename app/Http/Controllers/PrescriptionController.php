<?php

namespace App\Http\Controllers;

use App\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{

    public function addPrescription()
    {
        return view('user.prescription');
    }
    protected function prescriptionAdd(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required'],
            'course' => ['required'],
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/prescrpiton/' . $user->f_name . '/details/' . $filename;
            $file->move(public_path() . "/prescrpiton/" . $user->f_name . "/details/", $filename);
        }
        $prescription = Prescription::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'course' => $request['course'],
            'status' => 'Pending',
            'image' => $path,
            'user_id' => $userId,

        ]);
        return redirect()->route('show.request')->with('status','prescription send Successfully');

    }
    public function userRequest()
    {
        $prescriptions=Prescription::latest()->get();
       return view('user.showPrescriptionRequest',compact('prescriptions'));
     }
     public function prescriptionUpdate(Prescription $prescription){
        return view('user.updatePrescription',compact('prescription'));
     }
     public function updatePrescription(Request $request, Prescription $prescription)
     {  
        $user = Auth::user();
        $userId = $user->id;
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required'],
            'course' => ['required'],
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/prescrpiton/' . $user->f_name . '/details/' . $filename;
            $file->move(public_path() . "/prescrpiton/" . $user->f_name . "/details/", $filename);
        }
          else {
             $path = $prescription->image;
         }
         $prescription->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'course' => $request['course'],
            'status' => 'Pending',
            'image' => $path,
            'user_id' => $userId,
 
         ]);
         return redirect()->route('show.request')->with('status', 'Update successfully!');
     }
}
