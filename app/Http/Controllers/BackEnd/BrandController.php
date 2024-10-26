<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
    	$read = "All Brand";
    	$lists = Brand::oldest()->get();
    	return view('back-end.brand.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Brand";
    	return view('back-end.brand.create',compact('create'));
    }

    public function store(Request $request){

        $info = new Brand();
        $info->brand_name = $request->brand_name;
        $info->brand_slug = Str::slug($request->brand_name);

        if($request->hasFile('brand_icon')){
            $path = public_path('back-end/brand/');
            $file = $request->brand_icon;
            $fileName = time().'.'.$file->getClientOriginalName();
            $file->move($path,$fileName);
            $info->brand_icon = $fileName; 
        }
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Brand";
        $info = Brand::findOrFail($id);
    	return view('back-end.brand.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Brand::findOrFail($request->id);
        $info->brand_name = $request->brand_name;
        $info->brand_slug = Str::slug($request->brand_name);

         if($request->hasfile('brand_icon')){
            $destination = public_path('back-end/brand/').$info->brand_icon;
            if(file_exists($destination)){
                @unlink($destination);
            }
            $file = $request->file('brand_icon');
            $name = $file->getClientOriginalName();
            $fileName = time().'.'.$name;
            $file->move(public_path('back-end/brand'),$fileName);
            $info->brand_icon = $fileName;
        }
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('brand.index');
    }

    public function delete($id){
       $info = Brand::findOrFail($id);
        if($info){
           @unlink(public_path('back-end/brand/'.$info->brand_icon));
           $info->delete(); 
        }
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('brand.index');
    }
}
