<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
     public function index(){
    	$read = "All Subcategory";
    	$lists = Subcategory::with('category')->oldest()->get();
    	return view('back-end.subcategory.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Subcategory";
    	$categories = Category::oldest()->get();
    	return view('back-end.subcategory.create',compact('create','categories'));
    }

    public function store(Request $request){

        $info = new Subcategory();
        $info->category_id = $request->category_id;
        $info->subcat_name = $request->subcat_name;
        $info->subcat_slug = Str::slug($request->subcat_name);

        $files = ['subcat_icon' => 'icon', 'subcat_banner1' => 'banner'];
            foreach ($files as $field => $path) {
                if ($request->hasFile($field)) {
                    $fileName = time() . '.' . $request->$field->getClientOriginalName();
                    $request->$field->move(public_path("back-end/subcategory/{$path}/"), $fileName);
                    $info->$field = $fileName;
                }
            }

        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Subcategory";
        $info = Subcategory::findOrFail($id);
        $categories = Category::oldest()->get();
    	return view('back-end.subcategory.edit',compact('edit','info','categories'));
    }

    public function update(Request $request){

    	$info = Subcategory::findOrFail($request->id);
    	$info->category_id = $request->category_id;
        $info->subcat_name = $request->subcat_name;
        $info->subcat_slug = Str::slug($request->subcat_name);

         
    $files = [
        'subcat_icon' => 'icon',
        'subcat_banner1' => 'banner'
    ];

    foreach ($files as $field => $path) {
        if ($request->hasFile($field)) {
            $destination = public_path("back-end/subcategory/{$path}/") . $info->$field;
            if (file_exists($destination)) {
                @unlink($destination);
            }
            $file = $request->file($field);
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path("back-end/subcategory/{$path}/"), $fileName);
            $info->$field = $fileName;
        }
    }

        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('subcategory.index');
    }

    public function delete($id){
       $info = Subcategory::findOrFail($id);
        if($info){
           @unlink(public_path('back-end/subcategory/'.$info->subcat_icon));
           $info->delete(); 
        }
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('subcategory.index');
    }
}
