<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class CardsAndCollections extends Pivot
{
    protected $table = 'cards_and_collections';
    
    /**
     * Get the cards.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
    
    /**
     * Get the collections.
     */
    public function collections()
    {
        return $this->hasMany('App\CardCollections');
    }
}
