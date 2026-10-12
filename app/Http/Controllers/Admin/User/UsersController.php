<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\utils\imageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $users=User::when(request()->keyword, function($query){
            $query->where('name','LIKE', '%'.request()->keyword.'%')
                  ->orWhere('email','LIKE', '%'.request()->keyword.'%');

        })->when(!is_null(request()->status), function($query){
            $query->where('status', request()->status);

        })
        ->orderBy(request('sort_by', 'id'),request('order_by', 'asc'))
        
        ->paginate(request('limit_by', 5));
        
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // $request->validate('');
        $request->merge([
            'email_verified_at'=>$request->email_verified_at==1? now() : null,
        ]);
        $user= User::create($request->except('_token', 'image', 'password_confirmation'));
        imageManger::uploadImages($request,null,$user);
        return redirect()->back()->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user= User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user= User::findOrFail($id);
        imageManger::deleteImageFromLocal($user->image);
        $user->delete();
        return redirect()->route('admin.users.index')
        ->with('success' , 'User Deleted Successfuly!');
    }
    public function changeStatus($id){
        $user = User::findOrFail($id);
        if($user->status == 1){
            $user->update([
                'status'=>0,
            ]);
            Session::flash('success', 'User Blocked Successfuly!');

        }else{
                $user->update([
                'status'=>1,
            ]);
            Session::flash('success', 'User Active Successfuly!');
        }
        return redirect()->back();

    }
}
