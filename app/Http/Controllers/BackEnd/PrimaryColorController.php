<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\PrimaryColor;


class PrimaryColorController extends Controller
{
    // Show the create form
    public function create()
    {
        $info = PrimaryColor::first();
        return view('back-end.primary-color.create', [
            'action' => $info ? route('primary-color.update', $info->id) : route('primary-color.store'), 
            'method' => $info ? 'PATCH' : 'POST', 
            'create' => $info ? 'Edit primary-color' : 'Create primary-color',
            'info' => $info
        ]);
    }

    // Store the new data
    public function store(Request $request)
    {
        $request->validate([
            'primary_color' => 'required',
        ]);

        PrimaryColor::create($request->all());
        Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('primary-color.create');
    }

    // Show the edit form
    public function edit($id)
    {
        $info = PrimaryColor::findOrFail($id);
        return view('back-end.primary-color.create', [
            'info' => $info, 
            'action' => route('primary-color.update', $info->id), 
            'method' => 'PATCH', 
            'create' => 'Edit primary-color'
        ]);
    }

    // Update the existing data
    public function update(Request $request, $id)
    {
        $request->validate([
            'primary_color' => 'required',
        ]);

        $info = PrimaryColor::findOrFail($id);
        $info->update($request->all());
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('primary-color.create');
    }
}
