<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LinkType;

class LinkTypeController extends Controller
{
    public function index(){
        $read = "All Link Type";
    	$lists = LinkType::oldest()->get();
        return view('back-end.link_type.index', compact('lists', 'read'));
    }

    public function create(){
        $create = "Create Link Type";        
    	return view('back-end.link_type.create',compact('create'));
    }

    public function store(Request $request){

        $count = LinkType::count();
        if($count >= 2){
            Toastr::error('You can not add more than 2 link type', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('link_type.index');
        }

        $request->validate([
            'name' => 'required',
        ]);

        $info = new LinkType();
        $info->name = $request->name;
        $info->slug = Str::slug($request->name);
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link_type.index');
    }

    public function edit($id){
        $edit = "Update Link Type";
        $info = LinkType::findOrFail($id);
    	return view('back-end.link_type.edit',compact('edit','info'));
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        
    	$info = LinkType::findOrFail($request->id);
        $info->name = $request->name;
        $info->slug = Str::slug($request->name);
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link_type.index');
    }

    public function delete($id){
       $info = LinkType::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link_type.index');
    }

    public function status($id){
        $info = LinkType::findOrFail($id);
        status($info);
        Toastr::success('Status Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('link_type.index');
    }
}
