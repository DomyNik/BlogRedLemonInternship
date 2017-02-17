<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'category_post', 'post_id', 'category_id');
    }

}
