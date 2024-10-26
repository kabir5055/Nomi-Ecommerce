<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Auth;

use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use lemonpatwari\bangladeshgeocode\Models\Union;

class ShippingAddressController extends Controller
{
    public function create(Request $request){

        $sub_total = $request->sub_total;

        $divisions = Division::with('districts')->get(); // districts hasMany
        $districts = District::with('division','thanas')->get(); //division belongsTo and thanas hasMany
        $thanas = Thana::with('district','unions')->get(); //district belongsTo and unions hasMany;
        $unions = Union::all();

    	return view('front-end.checkout.shipping-address', compact('sub_total','divisions','districts','thanas','unions'));
    }

  public function store(Request $request){
        // Validation
        $this->validate($request,[
            "division_id" => "required",
            "district_id" => "required",
            "thana_id" => "required",
            "name" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        if (Auth::check()) {
            $info_id = Auth::id();  
        } else {
            $info_id = Session::getId();
        }

        session(['sub_total' => $request->sub_total]);

        // Check if a shipping address already exists for this session
        $existingAddress = ShippingAddress::where('info_id', $info_id)->first();

        if ($existingAddress) {
            // Redirect to payment if address exists
            return redirect()->route('front.payment');
        } else {
            // Save new shipping address
            $info = new ShippingAddress();
            $info->info_id = $info_id;
            $info->division_id = $request->division_id;
            $info->district_id = $request->district_id;
            $info->thana_id = $request->thana_id;
            $info->union_id = $request->union_id;
            $info->name = $request->name;
            $info->email = $request->email;
            $info->phone = $request->phone;
            $info->address = $request->address;
            $info->save();

            Toastr::success('Shipping Address Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('front.payment');
        }
    }

    public function getDistricts($division_id)
    {
        $districts = District::where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    public function getThanas($district_id)
    {
        $thanas = Thana::where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    public function getUnions($thana_id)
    {
        $unions = Union::where('thana_id', $thana_id)->get();
        return response()->json($unions);
    }


}
