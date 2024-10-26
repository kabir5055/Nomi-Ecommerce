<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;


class PurchaseController extends Controller
{
    public function purchaseHistory() {
        if (Auth::check()) {
            $info_id = Auth::id();
        } else {
            $info_id = Session::getId();
        }

        $orders = Order::where('info_id', $info_id)->get();

        return view('front-end.purchase-history.history', compact('orders'));
    }

    public function purchaseHistoryDetails($id) {

        $order_details = OrderDetails::with(['order', 'product'])->where('order_id', $id)->get();

        return view('front-end.purchase-history.history-details', compact('order_details'));
    }

}
