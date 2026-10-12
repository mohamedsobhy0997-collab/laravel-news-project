<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->only('showLoginform','checkAuth');
         $this->middleware('auth:admin')->only('logout');
    }
    public function showLoginform(){
        return view('admin.auth.login');

    }

    public function checkAuth(Request $request){
        $request->validate($this->filterData());
        if(Auth:: guard('admin')->attempt(['email'=> $request->email , 'password'=> $request->password], $request->remember)){
            return redirect()->intended(RouteServiceProvider::AdminHome);

            
        }
        return redirect()->back()->with('error','credentials does not match! ');
    }
    private function filterData ():array
    {
        return [
            'email'=>['required', 'email'],
            'password'=>['required', 'min:8'],
            'remember'=>['in:on,of'],
        ];

    }
     public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');

     }
}
