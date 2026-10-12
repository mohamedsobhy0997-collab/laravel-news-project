<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\comment;
use App\Models\Image;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory, Sluggable;
 protected $guarded=[];

public function category(){

 return $this->belongsTo(Category::class,'category_id');
}


public function user(){

 return $this->belongsTo(User::class,'user_id');
}

public function comments(){
    return $this->hasMany(comment::class, 'post_id');
}

public function images(){
    return $this->hasMany(Image::class, 'post_id');
}

 public function sluggable(): array
    {
        return [
            'slug' => [
            'source' => 'title'
            ]
        ];
    }
public function scopeActive($query){
   return $query->where('status',1);
}

public function admin(){
    return $this->belongsTo(Admin::class,'admin_id');
}

}
