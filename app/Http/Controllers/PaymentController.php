<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Payment;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{
    public function index(Order $order)
    {
        return view('user.order.payment',compact('order'));
    }

    public function store(Request $request,Order $order){

        $this->validate($request,[
            'account_no' => 'required',
            'trx_id' => ['required','unique:payments'],
            'method' => 'required',
        ]);

        Payment::create([
            'order_id' => $order->id,
            'account_no' => $request->account_no,
            'trx_id' => $request->trx_id,
            'method' => $request->method,
            'amount' => $order->total,
            'status' => 'Unverified',
        ]);

        $order->status = 'Payment Verification Pending';
        $order->save();
        return redirect()->route('home')->with('status','Payment Added Successfully');
    }

    public function verify(Request $request, Payment $payment){
        $payment->status = 'Verified';
        $payment->save();
        $payment->order->status = 'Payment Verified';
        $payment->order->save();
        return back()->with('status','Payment Verified');
    }

    public function declined(Request $request, Payment $payment){
        $payment->status = 'Declined';
        $payment->save();
        $payment->order->status = 'Payment Pending';
        $payment->order->save();
        return back()->with('error','Payment Declined');
    }

    public function allPayments()
    {
        $payments = Payment::all();
        return view('admin.order.payments',compact('payments'));
    }

    public function allUserPayments()
    {
        $orders = $orders = Auth::user()->orders;
        return view('user.order.allpayments',compact('orders'));
    }
}
