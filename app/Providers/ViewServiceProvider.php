<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\RlatedNewsSite;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;




class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Cache::forget('latest_posts');

        $rlatedsites=RlatedNewsSite::select('name', 'url')->get();
        $categories=Category::active()->select('id','slug','name')->get();

        
       
        
        view()->share([
            
             'rlatedsites'=> $rlatedsites,
            'categories'=> $categories,




        ]);

    }
}
  



