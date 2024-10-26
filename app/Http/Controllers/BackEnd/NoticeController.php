<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index(){
        $read = "All Notices";
    	$lists = Notice::oldest()->get();
        return view('back-end.notice.index', compact('lists', 'read'));
    }

    public function create(){
        $create = "Create notices";        
    	return view('back-end.notice.create',compact('create'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $info = new Notice();
        $info->name = $request->name;
        $info->slug = Str::slug($request->name).'-'.Str::random(5);
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('notice.index');
    }

    public function edit($id){
        $edit = "Update notices";
        $info = Notice::findOrFail($id);
    	return view('back-end.notice.edit',compact('edit','info'));
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
    	$info = Notice::findOrFail($request->id);
        $info->name = $request->name;
        $info->slug = Str::slug($request->name).'-'.Str::random(5);
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('notice.index');
    }

    public function delete($id){
       $info = Notice::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('notice.index');
    }

    public function status($id){
        $info = Notice::findOrFail($id);
        status($info);
        Toastr::success('Status Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('notice.index');
    }
}
