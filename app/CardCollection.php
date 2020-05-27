<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CardsAndCollections;

class CardCollection extends Model
{
    // table name
    protected $table = 'card_collections';
    
    /**
     * The cards that belong to the collection.
     */
    public function cards()
    {
        return $this->belongsToMany('App\Card', 'cards_and_collections', 'collection_id', 'card_id');
    }
    
    /**
     * Get the cards in this collection.
     *
    public static function cards($id)
    {
        $cards = CardsAndCollections::find($id)->collections();
        
        return $cards;
    } */
}
