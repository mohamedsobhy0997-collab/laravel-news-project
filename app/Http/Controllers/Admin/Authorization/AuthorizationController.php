<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizations= Authorization::paginate(5);
        return view('admin.authorization.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authorization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        $authorization = new Authorization();
        $this->roles($authorization , $request);
        return redirect()->back()->with('success' , ' Role Create Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authorization= Authorization::findOrFail($id);
        return view('admin.authorization.edit', compact('authorization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authorization= Authorization::findOrFail($id);
        $this->roles($authorization , $request);
        return redirect()->route('admin.authorizations.index')->with('success' , ' Role Create Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Authorization::findOrFail($id);
        $role=$role->delete();
        if(!$role){
            return redirect()->back()->with('error', 'Try Again Latter');

        }
        return redirect()->back()->with('success', 'Delete Role Successfully!');

    }
    private function roles ($authorization ,$request ){
         $authorization->role=$request->role;
        $authorization->permissions=json_encode($request->permissions);
        $authorization->save();


    }
}
