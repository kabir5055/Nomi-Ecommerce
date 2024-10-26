<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Banner;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
     public function index(){
	    $read = "All Banner";
	    $lists = Banner::latest()->get();
	    return view('back-end.banner.index', compact('read', 'lists'));
    }

    public function create(){
    	$create = "Create Banner";
    	return view('back-end..banner.create',compact('create'));
    }

    public function store(Request $request){
	    $info = new Banner();
	     $info->banner_type = $request->banner_type;
	     $info->banner_title = $request->banner_title;
	     $info->banner_link = $request->banner_link;
	    $path = public_path('back-end/banner/');
	    
	    $fileFields = ['banner_image'];
	    
	    foreach ($fileFields as $field) {
	        if ($request->hasFile($field)) {
	            $file = $request->$field;
	            $fileName = time() . '.' . $file->getClientOriginalName();
	            $file->move($path, $fileName);
	            $info->$field = $fileName;
	        }
	    }

	    $info->save();
	    Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
	   return redirect()->route('banner.index');
    }

    public function edit($id){
        $edit = "Update Banner";
        $info = Banner::findOrFail($id);
    	return view('back-end.banner.edit',compact('edit','info'));
    }

	public function update(Request $request){
	    $info = Banner::findOrFail($request->id);
	    $info->banner_type = $request->banner_type;
	    $info->banner_title = $request->banner_title;
	    $info->banner_link = $request->banner_link;
	    $path = public_path('back-end/banner/');
	    $fileFields = ['banner_image'];

	    foreach ($fileFields as $field) {
	        if ($request->hasFile($field)) {
	            $oldFilePath = $info->$field ? $path . $info->$field : null;
	            
	            if ($oldFilePath && file_exists($oldFilePath)) {
	                @unlink($oldFilePath);
	            }

	            $fileName = time() . '.' . $request->$field->getClientOriginalName();
	            $request->$field->move($path, $fileName);
	            $info->$field = $fileName;
	        }
	    }

	    $info->save();
	    Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
	    return redirect()->route('banner.index');
	}


	public function delete($id){
	    $info = Banner::findOrFail($id);
	    $fileFields = ['banner_image'];
	    
	    foreach ($fileFields as $field) {
	        if ($info->$field) {
	            @unlink(public_path('back-end/banner/' . $info->$field));
	        }
	    }

	    $info->delete();
	    Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
	    return redirect()->route('banner.index');
	}
}
