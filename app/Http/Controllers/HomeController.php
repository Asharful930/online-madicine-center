<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicine;
use App\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        return view('home',compact('orders'));
    }
    public function welcome()
    {
        $medicines = Medicine::latest()->paginate(15);

        return view('welcome',compact('medicines'));
    }

    public function medicineSingle(Medicine $medicine)
    {
        $genName = explode(" ",$medicine->generic_name);
        $relatedMedicines = Medicine::where('generic_name','like','%'.$genName[0].'%')->take(3)->get();
        return view('single-medicine',compact('medicine','relatedMedicines'));
    }
    public function shippingPayment()
    {
        return view('shippingPayment');
    }
    public function termsAndConditons()
    {
        return view('tAndC');
    }
    public function privacyPolicy()
    {
        return view('privacyPolicy');
    }
    public function contactUs()
    {
        return view('contactUs');
    }
    public function aboutUs()
    {
        $about = "About Us";
        return view('contactUs',compact('about'));
    }
}
