<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Page;

class PageController extends Controller
{
    public function index(){
  
        $read = "All Pages";
    	$lists = Page::oldest()->get();
        return view('back-end.page.index', compact('lists', 'read'));
    }

    public function create(){
        $create = "Create Pages";        
    	return view('back-end.page.create',compact('create'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $info = new Page();
        $info->name = $request->name;
        $info->slug = Str::slug($request->name);
        $info->url = '/'.$info->slug;
        $info->content = $request->content;
    
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('page.index');
    }

    public function edit($id){
        $edit = "Update Pages";
        $info = Page::findOrFail($id);
    	return view('back-end.page.edit',compact('edit','info'));
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);
        
    	$info = Page::findOrFail($request->id);
        if ($info->name !== $request->name) {
            $info->name = $request->name;
            $info->slug = Str::slug($request->name);
            $info->url = '/'.$info->slug;
        }

        $info->content = $request->content;

        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('page.index');
    }

    public function delete($id){
       $info = Page::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('page.index');
    }

    public function status($id){
        $info = Page::findOrFail($id);
        status($info);
        Toastr::success('Status Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('page.index');
    }
}
