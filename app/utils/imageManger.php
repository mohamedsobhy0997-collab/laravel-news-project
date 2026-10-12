<?php
namespace App\utils;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class imageManger{
    public static function uploadImages($request , $post=null  , $user=null){
         if($request->hasFile('images')){
        foreach($request->images as $image){
            $file =self::generateImage($image);
             $path=self::storeImage($image, 'posts',  $file);

            $post->images()->create([
                'path'=>$path,
            ]);
        }

       }
       //uploade single image
             
   if($request->hasFile('image')){
        $image=$request->file('image');
        //delete image from local
        self::deleteImageFromLocal($user->image);
      
        //store new image in local
        $file =self::generateImage($image);
        $path=self::storeImage($image, 'users',  $file);

        //update image in db
        $user->update([
            'image'=>$path

        ]);
    
    }
       
    }
    public static function deletePost($post){
         if($post->images->count()>0){
            foreach($post->images as $image){
                self::deleteImageFromLocal($image->path);
                $image->delete();
                
            }

        }
    }
    public static function generateImage($image){
    $file=Str::uuid(). time(). $image->getClientOriginalExtension();
    return $file;


    }
    public static function storeImage($image, $path, $file_name){

    $path=$image->storeAs('uploads/'.$path,$file_name,['disk'=>'uploads']);
    return $path;

    }
    public static function deleteImageFromLocal($image_path){
        if(File::exists(public_path($image_path))){
                    File::delete(public_path($image_path));
                    

                }
    }
   
}