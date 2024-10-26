<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\User;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\ShippingCharge;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use Auth;
use App\Models\Page;


class FrontEndController extends Controller{

     public function home() {
        // Cache the data for 0 minutes
        $TodaysDealProducts = Cache::remember('todays_deal_products', 0, function () {
            return Product::where(['status' => 1, 'is_todays_deal' => 1])->latest()->limit(8)->get();
        });

        $FeaturedProducts = Cache::remember('featured_products', 0, function () {
            return Product::where(['status' => 1, 'is_featured' => 1])->latest()->limit(8)->get();
        });

        $homeCategories = Cache::remember('home_categories', 0, function () {
            return Category::with('categoryProduct')->where(['status' => 1, 'home_show' => 1])->limit(4)->get();
        });

        $sliderRightTop = Cache::remember('slider_right_top', 0, function () {
           return Banner::where('banner_type', 'slider_right_top')->latest()->first();
        });

        $sliderRightBottom = Cache::remember('slider_right_bottom', 0, function () {
            return Banner::where('banner_type', 'slider_right_bottom')->latest()->first();
        });

         $bannersOne = Cache::remember('banners_one', 0, function () {
            return Banner::where('banner_type', 'banner-1')->latest()->limit(3)->get();
        });

         $bannersTwo = Cache::remember('banners_two', 0, function () {
            return Banner::where('banner_type', 'banner-2')->latest()->limit(2)->get();
        });

        $categories = Cache::remember('categories', 0, function () {
            return Category::latest()->get();
        });

        $sliders = Cache::remember('sliders', 0, function () {
            return Slider::latest()->get();
        });


        return view('front-end.home.home', compact('categories', 'sliders', 'bannersOne', 'TodaysDealProducts', 'FeaturedProducts', 'homeCategories','bannersTwo','sliderRightTop','sliderRightBottom'));
    }

    public function details($product_slug) {
        $productDetails = Cache::remember("product_details_{$product_slug}", 0, function () use ($product_slug) {
            return Product::with('category', 'brand')->where('product_slug', $product_slug)->first();
        });

        $related_products = Cache::remember("related_products_{$productDetails->category_id}", 0, function () use ($productDetails) {
            return Product::where('category_id', $productDetails->category_id)
                ->where('product_slug', '!=', $productDetails->product_slug)
                ->limit(6)
                ->get();
        });

        return view('front-end.product.details', compact('productDetails', 'related_products'));
    }

    public function category_products($cat_slug) {
        $catInfo = Cache::remember("category_info_{$cat_slug}", 0, function () use ($cat_slug) {
            return Category::where('cat_slug', $cat_slug)->with('categoryProduct')->firstOrFail();
        });

        return view('front-end.product.category-products', [
            'categoryProducts' => $catInfo->categoryProduct,
            'subcategories' => $catInfo->subcategories,
            'catName' => $catInfo->cat_name,
            'catInfo' => $catInfo
        ]);
    }

   public function search_products(Request $request) {
    $searchItem = $request->input('search_item');

    // Cache the search results for 30 minutes
    $searchProducts = Cache::remember('search_products_' . $searchItem, 30, function() use ($searchItem) {
        return Product::where('product_name', 'like', '%' . $searchItem . '%')->get();
    });

    return view('front-end.product.search', compact('searchProducts', 'searchItem'));
}


   public function searchSuggest(Request $request) {
    $query = $request->input('query');

    // Cache the search suggestions for 30 minutes
    $suggestions = Cache::remember('search_suggestions_' . $query, 30, function() use ($query) {
        return Product::where('product_name', 'LIKE', '%' . $query . '%')->get(['product_name as name']);
    });

    return response()->json($suggestions);
}


    public function cart() {
        if (Auth::check()) {
            $info_id = Auth::id();
        } else {
            $info_id = Session::getId();
        }
        
        $carts = Cart::where('info_id', $info_id)->get();

        if ($carts->isEmpty()) {
            return view('front-end.product.empty-cart');
        }

        $SubTotalPrice = $carts->sum('unit_total');
        $shipping_charge = Cache::remember('shipping_charge', 0, function () {
            return ShippingCharge::first();
        });

        return view('front-end.product.cart', compact('carts', 'SubTotalPrice', 'shipping_charge'));
    }

    public function brand_products($brand_slug) {
        $brandInfo = Cache::remember("brand_info_{$brand_slug}", 0, function () use ($brand_slug) {
            return Brand::where('brand_slug', $brand_slug)->firstOrFail();
        });

        $brandProducts = Cache::remember("brand_products_{$brandInfo->id}", 0, function () use ($brandInfo) {
            return Product::where('brand_id', $brandInfo->id)->get();
        });

        return view('front-end.product.brand-products', compact('brandProducts', 'brandInfo'));
    }

    public function subcategory_products($subcat_slug) {
        $subcatInfo = Cache::remember("subcategory_info_{$subcat_slug}", 0, function () use ($subcat_slug) {
            return Subcategory::where('subcat_slug', $subcat_slug)->firstOrFail();
        });

        $subcategoryProducts = Cache::remember("subcategory_products_{$subcatInfo->id}", 0, function () use ($subcatInfo) {
            return Product::where('subcategory_id', $subcatInfo->id)->get();
        });

        return view('front-end.product.subcategory-products', compact('subcategoryProducts', 'subcatInfo'));
    }

    public function categories() {
        $categories = Category::oldest()->get();
        return view('front-end.category.categories',compact('categories'));
    }

    public function contact() {
        return view('front-end.pages.contact-us');
    }

     public function brands() {
        $brands = Brand::oldest()->get();
        return view('front-end.brand.brands',compact('brands'));
    }

     public function shop() {
    // Shop product data caching for a specific duration
    $shopProducts = Cache::remember('shop_products', 60, function () {
        return Product::inRandomOrder()
            ->limit(36)
            ->get();
        });
        return view('front-end.product.shop', compact('shopProducts'));
    }

    public function pages($slug) {
        $info = Page::where('slug', $slug)->first();
        return view('front-end.pages.page', compact('info'));
    }

    public function user_dashbaord(){
        
        if (!Auth::check()) {
            return redirect()->route('front.user.login');
        }
        return view('front-end.dashboard.dashboard');
    }


}
