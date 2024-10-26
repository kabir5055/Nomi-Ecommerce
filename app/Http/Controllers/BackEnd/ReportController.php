<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderDetails;

class ReportController extends Controller
{
    public function stock(){
       $products = Product::all();
       $apon = [];
       foreach($products as $data){
       	
       	  	$quantitySum = OrderDetails::where('product_id',$data->id)->sum('quantity');

       	  	$totalQuantity = 0;

       	  	if($quantitySum>0){
               $totalQuantity = $quantitySum;
               	$apon[] = [
	       	  		"product_name"=>$data->product_name,
	       	  		"product_quantity"=>$data->quantity,
	       	  		"sale_quantity"=>$totalQuantity,
       	  	    ];
       	  	}else{
	            $apon[] = [
	       	  		"product_name"=>$data->product_name,
	       	  		"product_quantity"=>$data->quantity,
	       	  		"sale_quantity"=>0,
       	  	    ];
       	  	}
       }
       return view('back-end.report.stock',['lists'=>$apon]);
    }


     public function product_wise_sale(){
       $products = Product::all();
       $apon = [];
       foreach($products as $data){
       	
       	  	$quantitySum = OrderDetails::where('product_id',$data->id)->sum('quantity');

       	  	$totalQuantity = 0;

       	  	if($quantitySum>0){
               $totalQuantity = $quantitySum;
               	$apon[] = [
	       	  		"product_name"=>$data->product_name,
	       	  		"sale_quantity"=>$totalQuantity,
       	  	    ];
       	  	}else{
	            $apon[] = [
	       	  		"product_name"=>$data->product_name,
	       	  		"sale_quantity"=>0,
       	  	    ];
       	  	}
       }
       return view('back-end.report.product-wise-sale',['lists'=>$apon]);
    }

}
