<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ShippingAddress;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function list(){
    	$read = "New Order";
    	$orders = Order::latest()->get();
    	return view('back-end.order.list',compact('read','orders'));
    }

     public function todays_order(){
        $read = "Today's Order";
        $todays = Carbon::today();
        $orders = Order::whereDate('created_at',$todays)->get();
        return view('back-end.order.todays-order',compact('read','orders','todays'));
    }

    public function details($info_id,$id){
    	$read = "Order Details";
    	$shipping = ShippingAddress::where('info_id',$info_id)->first();
    	$orderNo = Order::where('id',$id)->where('info_id',$info_id)->first();
    	$orders = OrderDetails::with('product')->where('order_id',$id)->where('info_id',$info_id)->get();
    	return view('back-end.order.order-details',compact('read','orders','orderNo','shipping'));
    }

     public function delivery_status_approved($info_id,$id){
        Order::where('id',$id)->where('info_id',$info_id)->update(["delivery_status"=>"approved"]);
        Toastr::success('Delivery Status Approved', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

      public function payment_status_paid($info_id,$id){
        Order::where('id',$id)->where('info_id',$info_id)->update(["payment_status"=>"paid"]);
        Toastr::success('Payment Status Paid Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function print($info_id,$id){
        $shipping = ShippingAddress::where('info_id',$info_id)->first();
        $orderNo = Order::where('id',$id)->where('info_id',$info_id)->first();
        $orders = OrderDetails::with('product')->where('order_id',$id)->where('info_id',$info_id)->get();
       $pdf = Pdf::loadView('back-end.order.print', compact('orders', 'orderNo', 'shipping'))->setOptions([
            'defaultFont' => 'SolaimanLipi',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
        ]);
        return $pdf->stream('invoice.pdf');
    }

}
