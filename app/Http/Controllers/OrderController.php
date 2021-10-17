<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicine;
use App\Order;
use App\OrderDetail;
use App\User;
use App\Shipping;
use App\Rating;
use Cart;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    public function addCart(Request $request,Medicine $medicine)
    {
        $this->validate($request,[
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $medicine->id,
            'name' => $medicine->medicine_name,
            'price' => $medicine->medicine_price,
            'quantity' => $request->quantity,
            'attributes' => array()
        ));
        return redirect()->back()->with('success','product added to cart');
    }
    public function updateCart(Request $request,Medicine $medicine)
    {
        $this->validate($request,[
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);
        Cart::update($medicine->id,array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));
        return redirect()->back()->with('success','Cart Updated!');
    }

    public function destroyCart(Request $request,Medicine $medicine)
    {
        Cart::remove($medicine->id);
        return redirect()->back()->with('success','Cart Updated!');
    }
    public function showCart()
    {
        $cart['count'] = Cart::getContent()->count();
        $medicines = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach($cart_items as $item){
            $medicine = Medicine::find($item->id);
            $medicine->quantity = $item->quantity;
            $medicine->subTotal = $item->getPriceSum();
            $medicines->push($medicine);
        }
        $cart['shops'] = $medicines->unique('shop')->count();
        return view('cart.index',compact('medicines','cart'));
    }

    public function adminCheckout(){
        $users = User::all();
        $cart['count'] = Cart::getContent()->count();
        $medicines = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach($cart_items as $item){
            $medicine = Medicine::find($item->id);
            $medicine->quantity = $item->quantity;
            $medicine->subTotal = $item->getPriceSum();
            $medicines->push($medicine);
        }
        $cart['shops'] = $medicines->unique('shop')->count();
        return view('admin.order.checkout',compact('medicines','cart','users'));
    }

    public function userCheckout(){
        $cart['count'] = Cart::getContent()->count();
        $medicines = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach($cart_items as $item){
            $medicine = Medicine::find($item->id);
            $medicine->quantity = $item->quantity;
            $medicine->subTotal = $item->getPriceSum();
            $medicines->push($medicine);
        }
        $cart['shops'] = $medicines->unique('shop')->count();
        return view('user.order.checkout',compact('medicines','cart'));
    }

    public function userOrderStore(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
        ]);
        if($request->type == 'self'){
            $this->validate($request,[
                'shipping_address' => 'required',
            ]);
        }else{
            $this->validate($request,[
                'shipped_to' => 'required',
                'contact' => 'required',
                'shipping_address' => 'required',
            ]);
        }
        $medicines = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach($cart_items as $item){
            $medicine = Medicine::find($item->id);
            $medicine->quantity = $item->quantity;
            $medicine->subTotal = $item->getPriceSum();
            $medicines->push($medicine);
        }

        $cart['shops'] = $medicines->unique('shop')->count();
        $totalShippingCost = 45 * $cart['shops'];
        $total = $cart['subTotal'] + $totalShippingCost;
        $order = Order::create([
            'user_id' => $request->user_id,
            'total'   => $total,
            'status'  => 'Payment Pending'
        ]);

        foreach($medicines as $medicine){
            OrderDetail::create([
                'order_id'    => $order->id,
                'medicine_id' => $medicine->id,
                'shop_id'     => $medicine->shop->id,
                'quantity'    => $medicine->quantity,
                'subtotal'    => $medicine->subTotal,
            ]);
        }

        if($request->type == 'self'){
            $user = User::find($request->user_id);
            if($user->address != $request->shipping_address){
                $user->address = $request->shipping_address;
                $user->save();
            }
            Shipping::create([
                'user_id' => $user->id,
                'order_id'=> $order->id,
                'shipped_to' => $user->f_name.' '.$user->l_name,
                'contact' => $user->contact,
                'address' => $user->address,
                'status' => 'Order Placed',
            ]);
        }else{
            Shipping::create([
                'user_id' => $request->user_id,
                'order_id'=> $order->id,
                'shipped_to' => $request->shipped_to,
                'contact' => $request->contact,
                'address' => $request->shipping_address,
                'status' => 'Order Placed',
            ]);
        }
        Cart::clear();
        return redirect()->route('/')->with('success','Order Placed Successfully');
    }


    public function adminOrderStore(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
        ]);
        if($request->type == 'self'){
            $this->validate($request,[
                'shipping_address' => 'required',
            ]);
        }else{
            $this->validate($request,[
                'shipped_to' => 'required',
                'contact' => 'required',
                'shipping_address' => 'required',
            ]);
        }
        $medicines = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach($cart_items as $item){
            $medicine = Medicine::find($item->id);
            $medicine->quantity = $item->quantity;
            $medicine->subTotal = $item->getPriceSum();
            $medicines->push($medicine);
        }

        $cart['shops'] = $medicines->unique('shop')->count();
        $totalShippingCost = 45 * $cart['shops'];
        $total = $cart['subTotal'] + $totalShippingCost;
        $order = Order::create([
            'user_id' => $request->user_id,
            'total'   => $total,
            'status'  => 'Payment Pending'
        ]);

        foreach($medicines as $medicine){
            OrderDetail::create([
                'order_id'    => $order->id,
                'medicine_id' => $medicine->id,
                'shop_id'     => $medicine->shop->id,
                'quantity'    => $medicine->quantity,
                'subtotal'    => $medicine->subTotal,
            ]);
        }

        if($request->type == 'self'){
            $user = User::find($request->user_id);
            if($user->address != $request->shipping_address){
                $user->address = $request->shipping_address;
                $user->save();
            }
            Shipping::create([
                'user_id' => $user->id,
                'order_id'=> $order->id,
                'shipped_to' => $user->f_name.' '.$user->l_name,
                'contact' => $user->contact,
                'address' => $user->address,
                'status' => 'Order Placed',
            ]);
        }else{
            Shipping::create([
                'user_id' => $request->user_id,
                'order_id'=> $order->id,
                'shipped_to' => $request->shipped_to,
                'contact' => $request->contact,
                'address' => $request->shipping_address,
                'status' => 'Order Placed',
            ]);
        }
        Cart::clear();
        return redirect()->route('/')->with('success','Order Placed Successfully');
    }

    public function UserSingleOrder(Order $order)
    {
        return view('user.order.singleOrder',compact('order'));
    }

    public function AdminSingleOrder(Order $order)
    {
        return view('admin.order.singleOrder',compact('order'));
    }

    public function ShopSingleOrder(Order $order)
    {
        return view('shop.order.singleOrder',compact('order'));
    }

    public function shippedProduct(OrderDetail $order_detail){

        if(auth('manager')->user()->id == $order_detail->shop_id){
            $order_detail->shipped = true;
            $order_detail->save();
            $totalProducts = count($order_detail->order->orderDetails);
            $shippedProducts = 0;
            foreach($order_detail->order->orderDetails as $od){
                if($od->shipped){
                    $shippedProducts += 1;
                }
            }
            if($totalProducts ==  $shippedProducts){
                $order_detail->order->status = "Shipped:Full";
            }else{
                $order_detail->order->status = "Shipped:Partial";
            }
            $order_detail->order->save();
            return redirect()->route('admin.index')->with('success','Product Shipped Successfully');
        }else{
            return abort(404);
        }
    }

    public function orderRating(Request $request, Order $order){
        $this->validate($request,[
            'rating' => ['required','min:0','max:5'],
            'feedback' => ['required','min:5','max:1000'],
        ]);
        foreach($order->orderDetails as $orderDetail){
            Rating::create([
                'rating' => $request->rating,
                'medicine_id' => $orderDetail->medicine->id,
                'order_id' => $order->id,
                'feedback' => $request->feedback,
            ]);
        }
        $order->status = "Completed";
        $order->save();
        return redirect()->route('home')->with('status','Feedback Provided!');
    }
}
