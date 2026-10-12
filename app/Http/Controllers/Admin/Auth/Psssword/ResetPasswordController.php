<?php

namespace App\Http\Controllers\Admin\Auth\Psssword;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($email){
        return view('admin.passwords.reset' , ['email'=>$email]);
    }
    public function resetPassword(Request $request){
        $request->validate($this->resetForm());
        $admin = Admin::where('email',$request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error' , ' Try Again Latter ');

        }
        $admin->update([
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('admin.login.show')->with('success', 'Your Password  Updata Successfully! ');
    }
    private function resetForm (){
        return ([
            'email'=>['required', 'email'],
            'password'=>['required', 'confirmed', 'min:8'],
            'password_confirmation'=>['required'],
        
        ]);
    }
}
