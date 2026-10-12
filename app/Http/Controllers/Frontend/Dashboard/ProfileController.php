<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Image;
use App\utils\imageManger;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



class ProfileController extends Controller
{
    public function index()
    {
        // $post=Post::active()->with(['images'])->where('user_id',auth()->user()->id)->get();
        $posts = auth()->user()->posts()->active()->with(['images'])->latest()->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }
    public function storePost(PostRequest $request)
    {

        // $request->validate('');
        try {
            DB::beginTransaction();
             $this->commentAble($request);
            // $request->merge(['user_id'=>auth()->user()->id]);
            //    $post=Post::create([$request->except(['_token','images'])]);
            $post = auth()->user()->posts()->create($request->except(['_token', 'images']));

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
    public function editpost($slug)
    {
        return $slug;
    }
    public function deletepost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        if (!$post) {
            // return redirect()->back()->with('success' , 'Try Again latter');
            abort(404);
        }
        imageManger::deletePost($post);


        $post->delete();
        return redirect()->back()->with('success', 'Post Delete successfully');
    }

    public function getComments($id)
    {
        // $post = Post::findOrfile($id);
        // $comments=$post->comments()->get();
        $comments = Comment::with('user')->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'data' => null,
                'msg' => 'No comment',
            ]);
        }
        return response()->json([
            'data' => $comments,
            'msg' => 'contain comments'
        ]);
    }
    public function showEditForm($slug)
    {
        $post = Post::with(['images'])->whereSlug($slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.dashboard.edit-post', compact('post'));
    }
    public function updataPost(PostRequest $request)
    {
        $post = Post::findOrFail($request->post_id);
        $this->commentAble($request);
        $post->update($request->except(['images', '_token', '_method', 'post_id']));

        //check image
        try{
            DB::beginTransaction();
             if ($request->hasFile('images')) {
            // if ($post->images()->count() > 0) {
            //     foreach ($post->images as $image) {
            //         $image_path = $image->path;
            //         if (File::exists(public_path($image_path))) {
            //             File::delete(public_path($image_path));
            //         }
            //         //delete db
            //         $image->delete();
            //     }
            // }
            imageManger::deletePost($post);
            //store local
            //      foreach($request->images as $image)
            //         {
            //             $file=Str::uuid() . time().$image->getClientOriginalExtension();
            //             $path=$image->storeAs('uploads/posts', $file, ['disk'=>'uploads']);
            //         }
            //         // store db
            //         $post->images()->create([
            //             'path'=> $path,

            //         ]);

            // }

            imageManger::uploadImages($request, $post);
        }
        DB::commit();


        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
       

        return  redirect()->route('frontend.dashboard.profile')
            ->with('success', 'Post update successfuly!');
    }
    private function commentAble($request)
    {
        return  $request->comment_able == "on" 
               ? $request->merge(['comment_able' => 1])
              : $request->merge(['comment_able' => 0]);
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
