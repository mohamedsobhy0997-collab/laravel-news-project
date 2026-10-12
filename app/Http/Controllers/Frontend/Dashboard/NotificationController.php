<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index (){
        // auth()->user()->notifications->markAsRead();
        return view('frontend.dashboard.notification');
    }
    public function delete(Request $request){
        $notification= auth()->user()->notifications->where('id', $request->notify_id)->first();
        $notification->delete();
        return redirect()->back()->with('success', 'تم حذف إشعار واحد بنجاح');


    }
    public function deleteAll(){
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('success', 'تم حذف كل الاشعارات');

    }
    public function readAll(){
        auth()->user()->unreadnotifications->markAsRead();
         return redirect()->back()->with('success', 'تم قراءة جميع الاشعارات ');

    }
}
