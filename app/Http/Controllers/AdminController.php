<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Shop;
use App\medicine;
use App\Reason;
use App\Seller;
use App\Prescription;
use App\Order;
class AdminController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.index',compact('orders'));
    }
    public function adminApproval()
    {
        return view('admin.approval.approval');
    }
    public function adminRequest()
    {
        $admins = Admin::where('is_active',false)->get();
        return view('admin.approval.adminRequest',compact('admins'));
    }
    protected function aciveAdmin(Request $request, Admin $admin){
        $admin->is_active = true;
        $admin->save();
        return redirect()->route('admin.approval.adminRequest')->with('status','Admin Activated Successfully');
    }
    protected function rejectAdmin(Request $request, Admin $admin){
        $admin->delete();
        return redirect()->route('admin.approval.adminRequest')->with('warning','Admin Rejected Successfully');
    }
    public function allAdmin()
    {
        $admins = Admin::where('is_active',true)->get();
        return view('admin.approval.allAdminList',compact('admins'));
    }

    public function adminProfile(Admin $admin)
    {

       return view('admin.profile.adminProfile',compact('admin'));
    }
    public function editAdmin(Admin $admin){
        $admins = Admin::where('is_active',true)->get();
        return view('admin.profile.updateAdminInfo',compact('admins','admin'));
    }

    protected function updateAdmin(Request $request, Admin $admin)
    {
        $this->validate($request,[
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => [ 'string', 'max:255','nullable'],
            'contact' => ['required', 'max:255'],
        ]);
       $admin->update([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
        ]);
        if($request->password != null){
            $admin->password = Hash::make($request['password']);
            $admin->save();
        }

        return redirect()->route('admin.profile',$admin->id)->with('status','admin Updated successfully!');
    }
    public function showShop(Seller $seller)
    {
        $shops = Shop::where('seller_id',$seller->id)->get();
       return view('admin.approval.showShop',compact('shops','seller'));
    }
    public function showMedicine(Shop $shop)
    {
        $medicines = medicine::where('shop_id',$shop->id)->get();
        return view('admin.approval.showMedicine',compact('medicines','shop'));
    }
    protected function deactiveSeller(Request $request, Seller $seller){
        $this->validate($request,[
            'reason' => 'required',
        ]);
        Reason::create([
            'reason' => $request->reason,
            'seller_id' => $seller->id
        ]);
        $seller->is_active = false;
        $seller->save();
        return redirect()->route('admin.approval.allSellerList',$seller->id)->with('status','Seller Deactive Successfully');
    }
    public function allInactiveSeller()
    {
        $sellers = Seller::where('is_active',false)->get();
        return view('admin.approval.activeSeller',compact('sellers'));
    }
    protected function activeSeller(Seller $seller){
        $seller->is_active = true;
        $seller->save();
        return redirect()->route('admin.approval.allSellerList')->with('status','Seller Activated Successfully');
    }
    public function delete(medicine $medicine)
    {
        $medicine->delete();
          return redirect()->back()->with('status', 'Medicine Deleted Successfully');
    }
    public function showPrescription()
    {
       $prescriptions=Prescription::all();
        return view('admin.user.showPrescription',compact('prescriptions'));
    }
    public function deletePrescription(Prescription $prescription)
    {
        $prescription->delete();
          return redirect()->back()->with('status', 'Prescription Deleted Successfully');
    }
}
