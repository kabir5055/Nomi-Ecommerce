<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreeShippingLimit;
use Brian2694\Toastr\Facades\Toastr;

class FreeShippingLimitController extends Controller
{
    public function index(){
        $read = "All Shipping Limit";
    	$lists = FreeShippingLimit::oldest()->get();
        return view('back-end.free-shipping-limit.index', compact('lists', 'read'));
    }

    public function create(){
        $create = "Create Shipping Limit";        
    	return view('back-end.free-shipping-limit.create',compact('create'));
    }

    public function store(Request $request){

        $request->validate([
            'amount' => 'required',
        ]);

        $info = new FreeShippingLimit();
        $info->amount = $request->amount;
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('free-shipping-limit.index');
    }

    public function edit($id){
        $edit = "Update Shipping Limit";
        $info = FreeShippingLimit::findOrFail($id);
    	return view('back-end.free-shipping-limit.edit',compact('edit','info'));
    }

    public function update(Request $request){

        $request->validate([
            'amount' => 'required',
        ]);
        
    	$info = FreeShippingLimit::findOrFail($request->id);
        $info->amount = $request->amount;
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('free-shipping-limit.index');
    }

    public function delete($id){
       $info = FreeShippingLimit::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('free-shipping-limit.index');
    }

    public function status($id){
        $info = FreeShippingLimit::findOrFail($id);
        $count = $info->where('status',1)->count();
        if($count >= 1 && $info->status == 0){
            Toastr::error('You can not active status more than 1 limit Amount', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('free-shipping-limit.index');
        }
        status($info);
        Toastr::success('Status Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('free-shipping-limit.index');
    }
    
}
