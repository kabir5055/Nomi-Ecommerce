<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Link;
use App\Models\LinkType;

class LinkController extends Controller
{
    public function index(){
        $read = "All Links";
    	$lists = Link::oldest()->get();
        return view('back-end.link.index', compact('lists', 'read'));
    }

    public function create(){
        $create = "Create Links"; 
        $linkTypes = LinkType::where('status',1)->get();       
    	return view('back-end.link.create',compact('create','linkTypes'));
    }

    public function store(Request $request){

        $count = Link::where('link_type_id',$request->link_type_id)->count();
        if($count >= 6){
            Toastr::error('You can not add more than 6 link under the 1 Link Type', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('link.index');
        }

        $request->validate([
            'link_type_id' => 'required',
            'link_name' => 'required',
            'url' => 'required',
        ]);

        $info = new Link();
        $info->link_type_id = $request->link_type_id;
        $info->link_name = $request->link_name;

        if (substr($request->url, 0, 3) === 'www' || substr($request->url, 0, 3) === 'WWW' || substr($request->url, 0, 4) === 'http') {
            $info->url = addHttpsIfMissing($request->url);
        }else{
            $url = env('APP_URL') . $request->url;
            $info->url = $url;
        }
        
        $info->slug = Str::slug($request->name);
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link.index');
    }

    public function edit($id){
        $edit = "Update Links";
        $info = Link::with('linkType')->findOrFail($id);
        $linkTypes = LinkType::where('status',1)->get();
    	return view('back-end.link.edit',compact('edit','info','linkTypes'));
    }

    public function update(Request $request){

        $request->validate([
            'link_type_id' => 'required',
            'link_name' => 'required',
            'url' => 'required',
        ]);
        
    	$info = Link::findOrFail($request->id);
        $info->link_type_id = $request->link_type_id;
        $info->link_name = $request->link_name;

        if (substr($request->url, 0, 3) === 'www' || substr($request->url, 0, 3) === 'WWW' || substr($request->url, 0, 4) === 'http') {
            $info->url = addHttpsIfMissing($request->url);
        }else{
            $url = env('APP_URL') . $request->url;
            $info->url = $url;
        }
        
        $info->slug = Str::slug($request->name);
        $info->description = $request->description;
        $info->save();
       Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link.index');
    }

    public function delete($id){
       $info = Link::findOrFail($id);
       $info->delete();
       Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->route('link.index');
    }

    public function status($id){
        $info = Link::findOrFail($id);
        status($info);
        Toastr::success('Status Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('link.index');
    }
}
