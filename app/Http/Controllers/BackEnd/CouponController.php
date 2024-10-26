<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(){
    	$read = "All Coupon";
    	$lists = Coupon::oldest()->get();
    	return view('back-end.coupon.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Coupon";
    	return view('back-end..coupon.create',compact('create'));
    }

    public function store(Request $request){
    	$info = new Coupon();
    	$info->coupon_code  = $request->coupon_code;
    	$info->amount  = $request->amount;
    	$info->save();
    	Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

      public function edit($id){
        $edit = "Update Coupon";
        $info = Coupon::findOrFail($id);
    	return view('back-end.coupon.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Coupon::findOrFail($request->id);
        $info->coupon_code  = $request->coupon_code;
    	$info->amount  = $request->amount;
    	$info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('coupon.index');
    }

    public function delete($id){
       $info = Coupon::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('coupon.index');
    }

}
