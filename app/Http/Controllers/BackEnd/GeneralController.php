<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\General;

class GeneralController extends Controller
{
    // Show the create form
    public function create()
    {
        $info = General::first();
        return view('back-end.general.create', [
            'action' => $info ? route('general.update', $info->id) : route('general.store'), 
            'method' => $info ? 'PATCH' : 'POST', 
            'create' => $info ? 'Edit General' : 'Create General',
            'info' => $info
        ]);
    }

    // Store the new data
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        General::create($request->all());
        Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('general.create');
    }

    // Show the edit form
    public function edit($id)
    {
        $info = General::findOrFail($id);
        return view('back-end.general.create', [
            'info' => $info, 
            'action' => route('general.update', $info->id), 
            'method' => 'PATCH', 
            'create' => 'Edit General'
        ]);
    }

    // Update the existing data
    public function update(Request $request, $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'footer_text' => 'required',
        ]);

        $info = General::findOrFail($id);
        $info->update($request->all());
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('general.create');
    }
}
