<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
        return view('frontend.contact');
    }
    public function store(ContactRequest $request){
        $request->merge([
            'ip_address'=>$request->ip(),
        ]);
        $contact=Contact::create($request->all());
        if(!$contact){
             Session::flash('error', 'contact us filed');
            return redirect()->back();

        }
        Session::flash('success', 'Your Msg Create Successfuly!');
          return redirect()->back();


         
   
    }
}
