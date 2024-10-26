<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Size;

class SizeController extends Controller
{
     public function index(){
    	$read = "All Size";
    	$lists = Size::oldest()->get();
    	return view('back-end.size.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Size";
    	return view('back-end.size.create',compact('create'));
    }

    public function store(Request $request){

        $info = new Size();
        $info->size_name = $request->size_name;
        $info->size_slug = Str::slug($request->size_name);
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Size";
        $info = Size::findOrFail($id);
    	return view('back-end.size.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Size::findOrFail($request->id);
        $info->size_name = $request->size_name;
        $info->size_slug = Str::slug($request->size_name);
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('size.index');
    }

    public function delete($id){
       $info = Size::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('size.index');
    }
}
