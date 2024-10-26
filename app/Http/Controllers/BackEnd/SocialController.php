<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Brian2694\Toastr\Facades\Toastr;


class SocialController extends Controller
{
    public function index(){
    	$read = "All Social";
    	$lists = Social::oldest()->get();
    	return view('back-end.social.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Social";
    	return view('back-end.social.create',compact('create'));
    }

    public function store(Request $request){

        if(Social::count() > 0){
            Toastr::error('Data Already Exists', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('social.index');
        }

        $info = new Social();

        $info->facebook = addHttpsIfMissing($request->facebook);
        $info->twitter = addHttpsIfMissing($request->twitter);
        $info->linkedin = addHttpsIfMissing($request->linkedin);
        $info->youtube = addHttpsIfMissing($request->youtube);

        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('social.index');
    }

    public function edit($id){
        $edit = "Update Social";
        $info = Social::findOrFail($id);
    	return view('back-end.social.edit',compact('edit','info'));
    }

    public function update(Request $request){

    	$info = Social::findOrFail($request->id);

        $info->facebook = addHttpsIfMissing($request->facebook);
        $info->twitter = addHttpsIfMissing($request->twitter);
        $info->linkedin = addHttpsIfMissing($request->linkedin);
        $info->youtube = addHttpsIfMissing($request->youtube);

        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('social.index');
    }

    public function delete($id){
        $info = Social::findOrFail($id);
        $info->delete();
        Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('social.index');
    }
}
