<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request){
        
        if(empty($request->email)){
        	Toastr::warning('Empty Email', 'Error', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
        }else{
             Subscriber::create([
            'email' => $request->email,
        ]);

         Toastr::success('Subscriber Successfully', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
        }
       
    }
}
