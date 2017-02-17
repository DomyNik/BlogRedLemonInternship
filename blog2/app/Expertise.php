<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'expertise_user', 'user_id','expertise_id');
    }

}
