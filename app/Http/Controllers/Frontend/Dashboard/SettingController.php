<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use App\utils\imageManger;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index (){
        $user=auth()->user();
        return view('frontend.dashboard.setting', compact('user'));
    }
    public function update( SettingRequest $request){
        // $request->validate('');
        $user=User::findOrfail(auth()->user()->id);
        $user->update($request->except(['_token','image']));

        imageManger::uploadImages($request,null,$user);

    return redirect()->back()->with('success','تم العملية بنجاح');

    }
    public function changePassword(Request $request){
        $request->validate([
            'current_password'=>['required'],
            'password'=>['required' , 'confirmed'],
            'password_confirmation'=>['required'],
        ]);
        if(!Hash::check($request->current_password , auth()->user()->password)){
            // return redirect()->back()->with('error', 'Password dose not match!');
            Session::flash('error','Password dose not match!');
            return redirect()->back();

        }
        $user=User::findOrFail(auth()->user()->id);
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        // return redirect()->back()->with('success', 'Your Password Change Succrssfully!');
            Session::flash('success','Your Password Change Succrssfully!');
            return redirect()->back();

    }
 
}
