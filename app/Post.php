<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable= ['title', 'content','user_id'];
    
    public function category(){
        return $this->belongsToMany('App\Category');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post_images(){
        return $this->hasMany('App\PostImage');
    }
}
