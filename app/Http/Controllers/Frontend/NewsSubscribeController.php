<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewsSubscribeMail;
use App\Models\NewsSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class NewsSubscribeController extends Controller
{
    public function store (Request $request){
        $request->validate([
            'email'=>['required','email', 'unique:news_subscribes,email'],
        ]);
        $NewsSubscribe=NewsSubscribe::create([
            'email'=>$request-> email,
        ]);
        if(!$NewsSubscribe){
            Session::flash('error', 'sorry Try again letter!');
            return redirect()->back();

        }
        Mail::To($request->email)->send(new NewsSubscribeMail );


        Session::flash('success', 'Thanks For Subscribe1');
        return redirect()->back();
    }
}
