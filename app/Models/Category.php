<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use HasFactory, Sluggable;
     protected $guarded=[];

     public function posts(){
        return $this->hasMany(post::class,'category_id');
     }
     public function scopeActive($query){
       return $query->where('status', 1);

     }
     public function sluggable(): array
    {
        return [
            'slug' => [
            'source' => 'name'
            ]
        ];
    }
}
