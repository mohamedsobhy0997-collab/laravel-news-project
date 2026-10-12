<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        // dd($slug);
//  dd(
//         $slug,
//         Category::where('slug', $slug)->first(),
//         Category::pluck('slug')
//     );
    // dd(request()->fullUrl(), $slug);


        $cateogry=Category::active()->whereslug($slug)->first();
        $posts=$cateogry->posts()->paginate(9);
        return view('frontend.category-posts' , compact('posts','cateogry'));
        
    }
}
