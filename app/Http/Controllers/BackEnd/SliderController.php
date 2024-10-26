<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(){
    	$read = "All Slider";
    	$lists = Slider::oldest()->get();
    	return view('back-end.slider.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Slider";
    	return view('back-end.slider.create',compact('create'));
    }

    public function store(Request $request){

        $info = new Slider();

        if($request->hasFile('image')){
            $path = public_path('back-end/slider/');
            $file = $request->image;
            $fileName = time().'.'.$file->getClientOriginalName();
            $file->move($path,$fileName);
            $info->image = $fileName; 
        }
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('slider.index');
    }

    public function edit($id){
        $edit = "Update Slider";
        $info = Slider::findOrFail($id);
    	return view('back-end.slider.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Slider::findOrFail($request->id);

         if($request->hasfile('image')){
            $destination = public_path('back-end/slider/').$info->image;
            if(file_exists($destination)){
                @unlink($destination);
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $fileName = time().'.'.$name;
            $file->move(public_path('back-end/slider'),$fileName);
            $info->image = $fileName;
        }
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('slider.index');
    }

    public function delete($id){
       $info = Slider::findOrFail($id);
        if($info){
           @unlink(public_path('back-end/slider/'.$info->image));
           $info->delete(); 
        }
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('slider.index');
    }
}
