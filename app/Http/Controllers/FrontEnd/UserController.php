<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;


class UserController extends Controller
{
    public function login(){
        return view('front-end.user.user-login');
    }

    public function login_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name_phone' => 'required',
            'password' => 'required',
        ]);

        // Try to authenticate with name or phone
        $user = User::where('name', $request->name_phone)
                    ->orWhere('phone', $request->name_phone)
                    ->first();

        // If user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);  // Log the user in
            return redirect()->route('front.user.dashboard');
        }

        // If login fails
        return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function register(){
        return view('front-end.user.user-register');
    }

    public function register_store(Request $request){
        //validation
        $this->validate($request,[
            'name'=>"required",
            'phone'=>"required",
            'password'=>"required",
        ]);

        $info = new User();
        $info->name = $request->name;
        $info->email = $request->email?$request->email:'';
        $info->phone = $request->phone;
        $info->password = Hash::make($request->password);
        $info->pass = $request->password;
        $info->save();
        return redirect()->route('front.user.login');
    }

    public function change_password(){
        return view('front-end.user.change-password');
    }

    public function change_password_store(Request $request){
        
        $this->validate($request,[
            'current_password'=>"required",
            'new_password'=>"required",
            'confirm_password'=>"required",
        ]);

        $user = Auth::user();
        
        if(Hash::check($request->current_password, $user->password)){
            if($request->new_password == $request->confirm_password){
                $user->password = Hash::make($request->new_password);
                $user->pass = $request->new_password;
                $user->save();

                Auth::logout();
                Toastr::success('Password changed successfully And Login with new password');
                return redirect()->route('front.user.login');
            }else{
                return redirect()->back()->withErrors(['confirm_password' => 'New password and confirm password does not match']);
            }
        }else{
            return redirect()->back()->withErrors(['current_password' => 'Current password does not match']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('front.user.login');
    }   

    public function update_view(){
        return view('front-end.user.update-profile');
    }

    public function profile_update(Request $request){
        // dd($request->all());
        // dd($request->hasFile('image'));
        $this->validate($request,[
            'name'=>"required",
            'email'=>"required",
            'phone'=>"required",
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->hasFile('image')) {
            $user->image = $this->saveImage($request);
        }
        $user->save();
        Toastr::success('Profile updated successfully');
        return redirect()->route('front.user.dashboard');
    }
    private function saveImage($request){
        $user = Auth::user();
        if($user->image){
            unlink(public_path('front-end/assets/images/user/'.$user->image));
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front-end/assets/images/user/'), $image_name);
            return $image_name;
        }
        return null;
    }

}
