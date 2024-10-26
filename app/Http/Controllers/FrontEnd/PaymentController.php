<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\FreeShippingLimit;

class PaymentController extends Controller
{
    public function payment_create(){
        $sub_total = session('sub_total');
        $free_shipping_limit = FreeShippingLimit::where('status', 1)->first();
    	return view('front-end.checkout.payment', compact('sub_total', 'free_shipping_limit'));
    }

    public function payment_store(Request $request){
        $request->validate([
            'payment_type' => 'required',
        ]);
       DB::beginTransaction();
        try {

            if (Auth::check()) {
                $info_id = Auth::id();  
            } else {
                $info_id = Session::getId();
            }

            $payment_type = $request->payment_type;
            if($payment_type=='cash'){

                $carts = Cart::where('info_id',$info_id)->get();

                $latestVoucher = Order::latest('id')->first();
                    $VoucherNumber = 0;
                    if ($latestVoucher == null) {
                        $VoucherNumber = "KSS-000001";
                    } else {
                        $latestVoucherNumber = $latestVoucher->order_no;
                        $VoucherNumber = "KSS-" . str_pad(intval(substr($latestVoucherNumber, 4)) + 1, 6, '0', STR_PAD_LEFT);
                    }

                    $order = new Order();
                    $order->info_id = $info_id;
                    $order->order_no = $VoucherNumber;
                    $order->grand_total = $request->grand_total;
                    $order->subtotal_amount = $request->sub_total;
                    $order->shipping_charge = $request->shipping_charge;
                    $order->coupon_amount = $request->discount_amount;
                    $order->date = Carbon::today()->format('d-m-Y');
                    $order->save();
                    $orderId = $order->id;

                $payment = new Payment();
                $payment->info_id = $info_id;
                $payment->grand_total = $request->grand_total;
                $payment->shipping_charge = $request->shipping_charge;
                $payment->payment_method = $payment_type;
                $payment->date = Carbon::today()->format('d-m-Y');
                $payment->save();

                foreach($carts as $cart){

                    $order_details = new OrderDetails();
                    $order_details->order_id = $orderId;
                    $order_details->info_id = $info_id;
                    $order_details->product_id = $cart->product_id;
                    $order_details->color = $cart->color;
                    $order_details->size = $cart->size;
                    $order_details->quantity = $cart->quantity;
                    $order_details->sale_price = $cart->sale_price;
                    $order_details->unit_total = $cart->unit_total;
                    $order_details->save();
                    
                    $cart= Cart::where('info_id',$info_id)->first();
                    $cart->delete();

                    if (!auth()->check()){
                        session()->flush();
                    }
                }

            } elseif ($payment_type == 'bkash' || $payment_type == 'nagad' || $payment_type == 'rocket') {

                        Toastr::error('This payment method is under construction.', 'Error', ["positionClass" => "toast-top-right"]);
                        return redirect()->back();
                    }

                    DB::commit();
                    Toastr::success('Payment Successful', 'Success', ["positionClass" => "toast-top-right"]);
                    return redirect()->route('front.payment.success');
                } catch (\Exception $e) {
                    DB::rollback();
                    Toastr::error('Payment Failed. Please try again.', 'Error', ["positionClass" => "toast-top-right"]);
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
    }

    public function payment_success(){
       return view('front-end.checkout.payment-success');
    }

}
