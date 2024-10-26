<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Logo;
use Illuminate\Support\Facades\Cache;

class LogoController extends Controller
{

   public function index(){
	    $read = "All Logo";
	    $lists = Logo::latest()->get();
	    return view('back-end.logo.index', compact('read', 'lists'));
    }

    public function create(){
    	$create = "Create Logo";
    	return view('back-end..logo.create',compact('create'));
    }

    public function store(Request $request){
	    $info = new Logo();
	    $path = public_path('back-end/logo/');
	    
	    $fileFields = ['frontend_logo', 'backend_logo', 'favicon'];
	    
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
	   return redirect()->route('logo.index');
    }

    public function edit($id){
        $edit = "Update Logo";
        $info = Logo::findOrFail($id);
    	return view('back-end.logo.edit',compact('edit','info'));
    }

	public function update(Request $request){
	    $info = Logo::findOrFail($request->id);
	    $path = public_path('back-end/logo/');
	    $fileFields = ['frontend_logo', 'backend_logo', 'favicon'];

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
	    return redirect()->route('logo.index');
	}


	public function delete($id){
	    $info = Logo::findOrFail($id);
	    $fileFields = ['frontend_logo', 'backend_logo', 'favicon'];
	    
	    foreach ($fileFields as $field) {
	        if ($info->$field) {
	            @unlink(public_path('back-end/logo/' . $info->$field));
	        }
	    }

	    $info->delete();
	    Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
	    return redirect()->route('logo.index');
	}

}
