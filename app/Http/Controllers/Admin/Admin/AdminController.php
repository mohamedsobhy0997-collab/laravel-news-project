<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $admins=Admin::where('id', '!=',Auth::guard('admin')->user()->id)->when(request()->keyword, function($query){
            $query->where('name','LIKE', '%'.request()->keyword.'%')
                  ->orWhere('email','LIKE', '%'.request()->keyword.'%');

        })->when(!is_null(request()->status), function($query){
            $query->where('status', request()->status);

        })
        ->orderBy(request('sort_by', 'id'),request('order_by', 'asc'))
        
        ->paginate(request('limit_by', 5));
        
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorizations=Authorization::select('id', 'role')->get();
        return view('admin.admins.create' , compact('authorizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admins=Admin::create($request->except(['_token', 'password_confirmation']));
        if(!$admins){
            return redirect()->back()->with('erorr' , 'Try Again Latter');
        }
        return redirect()->back()->with('success' , 'New Admin Create Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admins=Admin::findOrFail($id);
        return view('admin.admins.show',compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admins=Admin::findOrFail($id);
        $authorizations=Authorization::select('id', 'role')->get();
        return view('admin.admins.edit',compact('admins', 'authorizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function changeStatus($id){
        $admins = Admin::findOrFail($id);
        if($admins->status == 1){
            $admins->update([
                'status'=>0,
            ]);
            Session::flash('success', 'admins Blocked Successfuly!');

        }else{
                $admins->update([
                'status'=>1,
            ]);
            Session::flash('success', 'admins Active Successfuly!');
        }
        return redirect()->back();

    }
}
