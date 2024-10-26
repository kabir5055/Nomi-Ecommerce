<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Subscriber;
use Carbon\Carbon;

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
        return view('back-end.home.home',compact('totalOrder','totalCategory','totalProduct','totalBrand','todayOrders','totalSubscriber'));
    }
}
