<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index(){
    	$read = "All Unit";
    	$lists = Unit::oldest()->get();
    	return view('back-end.unit.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Unit";
    	return view('back-end.unit.create',compact('create'));
    }

    public function store(Request $request){

        $info = new Unit();
        $info->unit_name = $request->unit_name;
        $info->unit_slug = Str::slug($request->unit_name);
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Unit";
        $info = Unit::findOrFail($id);
    	return view('back-end.unit.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Unit::findOrFail($request->id);
        $info->unit_name = $request->unit_name;
        $info->unit_slug = Str::slug($request->unit_name);
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('unit.index');
    }

    public function delete($id){
       $info = Unit::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('unit.index');
    }
}
