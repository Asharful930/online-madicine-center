<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Seller;
use App\Shop;
class SellerController extends Controller
{
    public function index()
    {
        $count['totalShops'] = 0;
        $count['totalSale'] = 0;
        $shops = auth('sellers')->user()->shop;
        foreach($shops as $shop){
            if($shop->is_active){
                $count['totalShops']++;
                $count['totalSale'] += $shop->orders->sum('subtotal');
            }
        }

        return view('seller.index',compact('count'));
    }
    public function sellerApproval()
    {
        return view('seller.approval.approval');
    }

    public function sellerRequest()
    {
        $sellers = Seller::where('is_active',false)->get();
        return view('admin.approval.sellerRequest',compact('sellers'));
    }
    protected function aciveSeller(Request $request, Seller $seller){
        $seller->is_active = true;
        $seller->save();
        return redirect()->route('admin.approval.sellerRequest')->with('status','Seller Activated Successfully');
    }
    protected function rejectSeller(Request $request, Seller $seller){
        $seller->delete();
        return redirect()->route('admin.approval.sellerRequest')->with('warning','Seller Rejected Successfully');
    }
    public function allSeller()
    {
        $sellers = Seller::where('is_active',true)->get();
        return view('admin.approval.allSellerList',compact('sellers'));
    }
    public function sellerProfile(Seller $seller){
        return view('seller.profile.sellerProfile',compact('seller'));
    }
    public function editSeller(Seller $seller){
       return view('seller.profile.updateSeller',compact('seller'));
    }
    protected function updateSeller(Request $request,Seller $seller)
    {
        $this->validate($request,[
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => [ 'string', 'max:255','nullable'],
            'contact' => ['required', 'max:255'],
            'nid' => ['required', 'max:255']
        ]);

        $seller->update([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'nid' => $request['nid']
               ]);
        if($request->password != null){
           $seller->password = Hash::make($request['password']);
           $seller->save();
       }

        return redirect()->route('seller.profile',$seller->id)->with('status','profile edit successfully!');
    }


}
