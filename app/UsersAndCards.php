<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class UsersAndCards extends Pivot
{
    protected $table = 'users_and_cards';
    
    /**
     * Get the users.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    /**
     * Get the cards.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
    
}
