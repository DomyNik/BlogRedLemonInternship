<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position', 'firstname', 'lastname','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // user has many posts
    public function posts()
    {
        return $this->hasMany('App\Posts','author_id');
    }

    public function expertises()
    {
        //1) belongs to 2) the related join table 3) foreign key of 1 4) foreign key of 2 
        return $this->belongsToMany('App\Expertise', 'expertise_user', 'user_id', 'expertise_id');
    }


    //REMAINS TO BE SEEN IF NEEDED !!!!!!!!!!!!!!!!!!!!!!!!!
    public function can_publish()
    {
        $position = $this->position;
        if($position == 'editor')
        {
            return true;
        }
        return false;
    }

    // Know if editor
    public function is_editor()
    {
        $position = $this->position;
        if($position == 'editor')
        {
            return true;
        }
        return false;
    }

     public function is_contributor()
    {
        $position = $this->position;
        if($position == 'contributor')
        {
            return true;
        }
        return false;
    }

    
}
