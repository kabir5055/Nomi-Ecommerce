<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Subscriber;
use Carbon\Carbon;
use App\Models\OrderDetails;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrder = Order::count();
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $totalBrand = Brand::count();
        $totalSubscriber = Subscriber::count();
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        $todaysOrder = Order::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(10);
        return view('back-end.home.home',compact('totalOrder','totalCategory','totalProduct','totalBrand','todayOrders','totalSubscriber','todaysOrder'));
    }

    public function adminPurchaseHistoryDetails($id) {

        $order_details = OrderDetails::with(['order', 'product'])->where('order_id', $id)->get();

        return view('back-end.home.history-details', compact('order_details'));
    }
}
