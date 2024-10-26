<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Cache;

class AdditionalController extends Controller{

    public function get_subcategory(Request $request){
	    $category_id = $request->category_id;
	    $cacheKey = 'subcategories_for_category_' . $category_id;
	    $info = Cache::remember($cacheKey, 60, function () use ($category_id) {
	        return Subcategory::where('category_id', $category_id)->get();
	    });
	    return response()->json($info);
    }

    public function subscribers(){
    	$lists = Subscriber::latest()->get();
    	return view('back-end.subscriber.subscribers',compact('lists'));
    }

}
