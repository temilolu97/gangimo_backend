<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];
    protected $table = 'categories';
    public function posts(){
        return $this->belongsToMany('App\Post');
    }

}
