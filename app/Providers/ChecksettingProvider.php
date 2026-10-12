<?php

namespace App\Providers;


use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class ChecksettingProvider extends ServiceProvider
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
       
       
        $get=Setting::firstOr(function(){
            return Setting::create([
                'site_name'=>'news',
                'email'=>'news@gmail.com',
                'favicon'=>'default',
                'logo'=>'/img/logo.png',
                'facebook'=>'https://www.facebook.com/',
                'twitter'=>'https://www.twitter.com/',
                'instagram'=>'https://www.instagram.com/',
                'youtube'=>'https://www.youtube.com/',
                'phone'=>'01226969589',
                'country'=>'Egypt',
                'city'=>'tanta',
                'street'=>'mohamed sobhy',
                'small_desc' => 'News website',

            ]);

        });


        $get->whatsapp= "https://wa.me/". $get->phone;

        view()->share([
            'get'=>$get,
           
        ]);
    }
}
