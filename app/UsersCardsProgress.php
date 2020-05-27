<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UsersCardsProgress extends Model
{
    protected $table = 'users_cards_progress';
    
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
        return $this->belongsToMany('App\Card', 'users_cards_progress', 'user_id', 'card_id');
    }
    
}
