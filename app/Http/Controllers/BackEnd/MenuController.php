<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MenuController extends Controller
{

    public function index()
    {
        $read = "All Menu";
        $lists = Menu::all();
        return view('back-end.menu.index', compact('lists', 'read'));
    }

    public function create()
    {
        $create = "Menu Create";
        return view('back-end.menu.create', compact('create'));
    }

    public function store(Request $request)
    {
        //store menu
        $info = new Menu();
        $info->menu_name = $request->menu_name;
        $info->menu_url = $request->menu_url;
        $info->menu_position = $request->menu_position;
        $info->save();
        Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('menu.index');

    }

    public function edit($id)
    {
       $edit = "Update Menu";
        $info = Menu::findOrFail($id);
        return view('back-end.menu.edit', compact('info', 'edit'));
    }

    public function update(Request $request)
    {
        //update menu
        $menu = Menu::findOrFail($request->id);
        $menu->menu_name = $request->menu_name;
        $menu->menu_url = $request->menu_url;
        $menu->menu_position = $request->menu_position;
        $menu->save();
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('menu.index');
    }

    public function delete($id)
    {
        //delete menu
        $menu = Menu::findOrFail($id);
        $menu->delete();
        Toastr::success('Data Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('menu.index');
    }

}
