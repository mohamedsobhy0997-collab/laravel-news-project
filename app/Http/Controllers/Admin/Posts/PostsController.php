<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\utils\imageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Image;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $posts=Post::when(request()->keyword, function($query){
            $query->where('title','LIKE', '%'.request()->keyword.'%');
                  

        })->when(!is_null(request()->status), function($query){
            $query->where('status', request()->status);

        })
        ->orderBy(request('sort_by', 'id'),request('order_by', 'asc'))
        
        ->paginate(request('limit_by', 5));
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::select('id','name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
          try {
            DB::beginTransaction();
          
            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));

            imageManger::uploadImages($request, $post);


            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }

        Session::flash('success', 'Post Create Successfuly');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post= Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->except(['images', '_token', '_method']));

        
        try{
            DB::beginTransaction();
             if ($request->hasFile('images')) {
            imageManger::deletePost($post);
            imageManger::uploadImages($request, $post);
        }
        DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
       
        return  redirect()->route('admin.posts.index')
            ->with('success', 'Post update successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts=Post::findOrFail($id);
        imageManger::deletePost($posts);
        $posts->delete();
        return redirect()->route('admin.posts.index')
        ->with('success', 'Delete Posts Successfully!');
    }
    public function changeStatus($id){
       $posts=Post::findOrFail($id);
       if($posts->status==1){
        $posts->update([
            'status'=>0
        ]);
          Session::flash('success', 'Post Blocked Successfuly!');

        }else{
                $posts->update([
                'status'=>1,
            ]);
            Session::flash('success', 'Post Active Successfuly!');
        }
        return redirect()->back();

       }
        public function deletePostImage(Request $request, $image_id)
    {
        $image = Image::find($request->key);
        if (!$image) {
            return response()->json([
                'status' => '201',
                'msg' => 'Image Not Fount',
            ]);
        }
        //delete image from local
        //  if(File::exists(public_path($image->path))){
        //     File::delete(public_path($image->path));
        //  }
        imageManger::deleteImageFromLocal('$image_path');
        $image->delete();
        return response()->json([
            'status' => '201',
            'msg' => 'Image delete successfully',
        ]);
    }
    }

