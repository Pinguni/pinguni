<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UsersAndCards extends Model
{
    protected $table = 'users_and_categories';
    
    /**
     * Get the users.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
}
