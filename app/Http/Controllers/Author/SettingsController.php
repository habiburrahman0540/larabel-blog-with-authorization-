<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class SettingsController extends Controller
{
    public function index(){
        return view('author.settings');
    }
    public function profile(){
        $user = User::findOrFail(Auth::id());
        return view('author.profile',compact('user'));
    }
    public function updateprofile(Request $request){
      $this->validate($request,[
          'name' => 'required',
          'email' => 'required|email', 
          'image' => 'required|image'  
      ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if(isset($image)){
            $currentdate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('profile')){
                 Storage::disk('public')->makeDirectory('profile');
            }
            if(Storage::disk('public')->exists('profile/'.$user->image)){
             Storage::disk('public')->delete('profile/'.$user->image);
        }
            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'. $imageName,$profile);
        }else{
            $imageName = $user->image;
            
        }
        $user->name =$request->name;
        $user->email =$request->email;
        $user->image =$imageName;
        $user->about =$request->about;
        $user->save();
        return redirect()->back()->with('successMsg','Profile updated successfully.');


    }
    public function updatepassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'  
        ]);
        $hashpassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashpassword )){
            if(!Hash::check($request->password,$hashpassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->back();
            }
            else{
                return redirect()->back()->with('loginerrorMsg','new password can not be same as old password.');
            }
        }
        else{
            return redirect()->back()->with('loginerrorMsg','Current password does not match.');
        
    

    }
}
}
