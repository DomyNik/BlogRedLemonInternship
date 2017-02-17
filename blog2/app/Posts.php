<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = [];

    public function author()
    {
    	return $this->belongsTo('App\User', 'author_id');
    }

    public function categories()
    {
    	//1) belongs to 2) the related join table 3) foreign key of 1 4) foreign key of 2 
    	return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'category_id');
    }

}
