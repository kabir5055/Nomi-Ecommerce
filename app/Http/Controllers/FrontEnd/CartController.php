<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{

    public function products_cart(Request $request){

        $instant = new Cart();
        $info = addToCart($instant, $request);
        $info->save();
        Toastr::success('Cart Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
      
    }

    public function buy_now(Request $request){

        $instant = new Cart();
        $info = addToCart($instant, $request);
        $info->save();
        Toastr::success('Please proceed To Buy', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect('/product/cart');
    }

    public function product_cart_update(Request $request){

    	if (Auth::check()) {
            $info_id = Auth::id();
        } else {
            $info_id = Session::getId();
        }
        
        $conditions = [
            'info_id' => $info_id,
            'product_id' => $request->product_id,
            'color' => $request->color??'',
            'size' => $request->size??'',
        ];

        $cart = Cart::where($conditions)->first();

        Cart::where($conditions)->update([
                        'quantity'=>$request->quantity,
                        'unit_total'=>$request->quantity*$cart->sale_price,
                       ]);
         Toastr::success('Quantity Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
          return redirect()->back();             
    }

    public function product_cart_delete($id){
        if (Auth::check()) {
            $info_id = Auth::id();
        } else {
            $info_id = Session::getId();
        }

        Cart::where('id',$id)->where('info_id', $info_id)->delete();
        Toastr::success('Cart Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back(); 
    }

    public function applyCoupon(Request $request){
        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if ($coupon) {
            // Assuming the coupon has a `discount_amount` field
            $discountAmount = $coupon->amount;
        } else {
            // No valid coupon found
            $discountAmount = 0;
        }

        return redirect()->back()->with('discountAmount', $discountAmount);
    }

}
