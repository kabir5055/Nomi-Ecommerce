<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ShippingCharge;


class ShippingChargeController extends Controller
{
     // Show the create form
    public function create()
    {
        $info = ShippingCharge::first();
        return view('back-end.shipping-charge.create', [
            'action' => $info ? route('shipping-charge.update', $info->id) : route('shipping-charge.store'), 
            'method' => $info ? 'PATCH' : 'POST', 
            'create' => $info ? 'Edit Shipping Charge' : 'Create Shipping Charge',
            'info' => $info
        ]);
    }

    // Store the new data
    public function store(Request $request)
    {
        $request->validate([
            'inside_charge' => 'required',
            'outside_charge' => 'required',
            'free_charge' => 'required',
        ]);

        ShippingCharge::create($request->all());
        Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('shipping-charge.create');
    }

    // Show the edit form
    public function edit($id)
    {
        $info = ShippingCharge::findOrFail($id);
        return view('back-end.shipping-charge.create', [
            'info' => $info, 
            'action' => route('shipping-charge.update', $info->id), 
            'method' => 'PATCH', 
            'create' => 'Edit Shipping Charge'
        ]);
    }

    // Update the existing data
    public function update(Request $request, $id)
    {
         $request->validate([
            'inside_charge' => 'required',
            'outside_charge' => 'required',
            'free_charge' => 'required',
        ]);

        $info = ShippingCharge::findOrFail($id);
        $info->update($request->all());
        Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('shipping-charge.create');
    }
}
