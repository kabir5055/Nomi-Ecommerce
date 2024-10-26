<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Color;

class ColorController extends Controller
{
  
  public function index(){
      $read = "All Color";
      $lists = [];

      Color::chunk(1000, function ($chunkColors) use (&$lists) {
          foreach ($chunkColors as $color) {
              $lists[] = $color;
          }
      });

      return view('back-end.color.index', compact('lists', 'read'));
  }

    public function create(){
    	$create = "Create Color";
    	return view('back-end.color.create',compact('create'));
    }

    public function store(Request $request){

        $info = new Color();
        $info->color_name = $request->color_name;
        $info->color_slug = Str::slug($request->color_name);
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Color";
        $info = Color::findOrFail($id);
    	return view('back-end.color.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Color::findOrFail($request->id);
        $info->color_name = $request->color_name;
        $info->color_slug = Str::slug($request->color_name);
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('color.index');
    }

    public function delete($id){
       $info = Color::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('color.index');
    }
}
