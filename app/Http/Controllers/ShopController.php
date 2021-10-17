<?php

namespace App\Http\Controllers;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\OrderDetail;

class ShopController extends Controller
{
    public function shop_request(){
    return view('seller.shop.shopRequest');
    }
    protected function createShop(Request $request)
    {
        $sellerID = Auth::guard('sellers')->user()->id;
        $this->validate($request,[
            'shop_name' => ['required', 'string', 'max:255'],
            'm_name' => ['required', 'string', 'max:255'],
            's_contact' => ['required', 'string', 'max:255'],
            's_address' => ['required', 'string', 'max:255'],
            'm_email' => ['required', 'string', 'email', 'max:255', 'unique:shops'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $shop = Shop::create([
        'shop_name' => $request['shop_name'],
        'm_name' => $request['m_name'],
        'm_email' => $request['m_email'],
        's_address' => $request['s_address'],
        's_contact' => $request['s_contact'],
        'password' => Hash::make($request['password']),
        'seller_id' => $sellerID
        ]);

        return redirect()->route('seller.index')->with('status','Shop request placed successfully!');
    }
    public function checkApprove()
    {
        $shops = Shop::where('is_active',false)->get();
        return view('admin.shops.shopRequests',compact('shops'));
    }
    public function approvalshop()
    {
        $shops = Auth::guard('sellers')->user()->shop;
        return view('seller.approval.approvalShop',compact('shops'));
    }
    protected function aciveShop(Request $request, Shop $shop){
        $this->validate($request,[
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $shop->latitude =  $request->latitude;
        $shop->longitude =  $request->longitude;
        $shop->is_active = true;
        $shop->save();
        return redirect()->route('admin.shop.requestApproved')->with('status','Shop Activated Successfully');
    }
    protected function rejectShop(Request $request, Shop $shop){
        $shop->delete();
        return redirect()->route('admin.shop.requestApproved')->with('warning','Shop Rejected Successfully');
    }
    public function managerApproval()
    {
        return view('shop.approval.approval');
    }
    public function index()
    {
        $orderDetails = OrderDetail::where('shop_id',auth('manager')->user()->id)->get();
        $orderDetails = $orderDetails->unique('order');
        return view('shop.index',compact('orderDetails'));
    }
    public function managerProfile(Shop $shop)
 {
    return view('shop.manager.managerProfile',compact('shop'));
 }
 protected function updateManager(Request $request,Shop $shop)
 {
     $this->validate($request,[
         'm_name' => ['required', 'string', 'max:255'],
         'm_email' => ['required', 'string', 'email', 'max:255'],
         'password' => [ 'string', 'max:255','nullable'],
     ]);

     $shop->update([

                        'm_name' => $request['m_name'],
                        'm_email' => $request['m_email'],
            ]);
     if($request->password != null){
        $shop->password = Hash::make($request['password']);
        $shop->save();
    }

     return redirect()->route('manager.profile',$shop->id)->with('status','profile edit successfully!');
 }
 public function editManager(Shop $shop){
    return view('shop.manager.updateProfile',compact('shop'));
 }


 public function editShop(Shop $shop){
    return view('seller.approval.updateShop',compact('shop'));
}
protected function updateShop (Request $request,Shop $shop)
{
    $this->validate($request,[
        'shop_name' => ['required', 'string', 'max:255'],
        'm_name' => ['required', 'string', 'max:255'],
        's_contact' => ['required', 'string', 'max:255'],
        's_address' => ['required', 'string', 'max:255'],
        'm_email' => ['required', 'string', 'email', 'max:255'],
        'latitude' => ['required', 'string','max:255'],
        'longitude' => ['required', 'string', 'max:255'],
        'password' => [ 'string', 'max:255','nullable'],
    ]);
    $shop->update([
    'shop_name' => $request['shop_name'],
    'm_name' => $request['m_name'],
    'm_email' => $request['m_email'],
    's_address' => $request['s_address'],
    's_contact' => $request['s_contact'],
    'latitude' => $request['latitude'],
    'longitude' => $request['longitude'],
    ]);
    if($request->password != null){
        $shop->password = Hash::make($request['password']);
        $shop->save();
    }

    return redirect()->route('seller.approval.approvalShop')->with('status','Shop  Update successfully!');
}
public function shopDelete(Shop $shop){
  $shop->delete();
  return redirect()->route('seller.approval.approvalShop')->with('status','Delete successfully!');

}




}
