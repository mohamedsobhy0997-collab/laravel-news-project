<?php

namespace App\Http\Controllers\Admin\Auth\Psssword;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public $otp2;
    public function __construct()
    {
        $this->otp2= new Otp;

    }
    public function showEmailform(){
        return view('admin.passwords.email');
    }
    public function sendOtp(Request $request){
        $request->validate([
            'email'=>['required' , 'email'],
        ]);
        $admin= Admin::where('email' , $request->email)->first();
        if(!$admin){
            return redirect()->back()->withErrors(['email'=> 'Try again Latter']);

        }
        $admin->notify(new SendOtpNotify);
        return redirect()->route('admin.password.showOtoform', ['email'=>$admin->email]);

    }
    public function showOtoForm ($email){
        return view('admin.passwords.confirm' , ['email'=>$email]);

    }
    public function verifyOtp(Request $request){
        $request->validate([
            'email'=>['required', 'email'],
            'token'=>['required','min:5'],
        ]);
        $otp= $this->otp2->validate($request->email , $request->token);
        if($otp->status == false){
            return redirect()->back()->withErrors(['token'=>' Code is invalid!']);

        }
        return redirect()->route('admin.password.resetform' , ['email'=>$request->email]);

    }
}
