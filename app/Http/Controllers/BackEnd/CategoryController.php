<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
    	$read = "All Category";
    	$lists = Category::withCount('categoryCount','categoryProduct')->oldest()->get();
    	return view('back-end.category.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Category";
    	return view('back-end.category.create',compact('create'));
    }

    public function store(Request $request){

        // $info = new Category();
        // $info->cat_name = $request->cat_name;
        // $info->cat_slug = Str::slug($request->cat_name);

        // if($request->hasFile('cat_icon')){
        //     $path = public_path('back-end/category/icon/');
        //     $file = $request->cat_icon;
        //     $fileName = time().'.'.$file->getClientOriginalName();
        //     $file->move($path,$fileName);
        //     $info->cat_icon = $fileName; 
        // }
        // $info->save();

        $info = new Category([
            'cat_name' => $request->cat_name,
            'cat_slug' => Str::slug($request->cat_name),
        ]);

        $files = ['cat_icon' => 'icon', 'cat_banner1' => 'banner'];
        foreach ($files as $field => $path) {
            if ($request->hasFile($field)) {
                $fileName = time() . '.' . $request->$field->getClientOriginalName();
                $request->$field->move(public_path("back-end/category/{$path}/"), $fileName);
                $info->$field = $fileName;
            }
        }

        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function edit($id){
        $edit = "Update Category";
        $info = Category::findOrFail($id);
    	return view('back-end.category.edit',compact('edit','info'));
    }

  public function update(Request $request){
    $info = Category::findOrFail($request->id);
    $info->cat_name = $request->cat_name;
    $info->cat_slug = Str::slug($request->cat_name);

    $files = [
        'cat_icon' => 'icon',
        'cat_banner1' => 'banner'
    ];

    foreach ($files as $field => $path) {
        if ($request->hasFile($field)) {
            $destination = public_path("back-end/category/{$path}/") . $info->$field;
            if (file_exists($destination)) {
                @unlink($destination);
            }
            $file = $request->file($field);
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path("back-end/category/{$path}/"), $fileName);
            $info->$field = $fileName;
        }
    }

    $info->save();

    Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
    return redirect()->route('category.index');
}

    public function delete($id){
       $info = Category::findOrFail($id);
        if($info){
           @unlink(public_path('back-end/category/icon/'.$info->cat_icon));
           $info->delete(); 
        }
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('category.index');
    }

    public function home_show_no($id){
        Category::where('id',$id)->update(['home_show'=>0]);
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('category.index');
    }

     public function home_show_yes($id){
        Category::where('id',$id)->update(['home_show'=>1]);
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('category.index');
    }

}
