<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
public function index()
{
    $categories = Category::withCount('posts')
        ->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })
        ->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
        ->orderBy(
            request('sort_by', 'id'),
            request('order_by', 'asc')
        )
        ->paginate(request('limit_by', 5));

    return view('admin.categories.index', compact('categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $categories=Category::create($request->only('name', 'status'));
        if(!$categories){
 return redirect()->route('admin.categories.index')
        ->with('error' , 'Try Again Letter!');
       
        }
         return redirect()->route('admin.categories.index')
        ->with('success' , 'Category  Create Successfuly!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
       $category=Category::findOrFail($id);
       $category->update($request->except(['_token','_method']));
       if(!$category){
         return redirect()->route('admin.categories.index')
        ->with('error' , 'Try Again Letter!');

       }
        return redirect()->route('admin.categories.index')
        ->with('success' , 'Category Update Successfuly!');
       


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories=Category::findOrfail($id);
        $categories->delete();
         return redirect()->route('admin.categories.index')
        ->with('success' , 'Category Deleted Successfuly!');
    
    }
       public function changeStatus($id){
        $categories = Category::findOrFail($id);
        if($categories->status == 1){
            $categories->update([
                'status'=>0,
            ]);
            Session::flash('success', 'categories Blocked Successfuly!');

        }else{
                $categories->update([
                'status'=>1,
            ]);
            Session::flash('success', 'categories Active Successfuly!');
        }
        return redirect()->back();

    }
}
