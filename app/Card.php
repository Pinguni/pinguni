<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * Scope a query to only include a card of a given id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
    
    /**
     * Scope a query to only include a card of a given title.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTitle($query, $title)
    {
        return $query->where('title', $title);
    }
    
    /**
     * Scope a query to only include cards of a given visibility.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfVisibility($query, $type)
    {
        return $query->where('visibility', $type);
    }
    
    /**
     * Scope a query to only include cards of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
    
    /**
     * Scope a query to only include cards not of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotOfType($query, $type)
    {
        return $query->where('type', '!=', $type);
    }
    
    /**
     * The cards that belong to the card.
     */
    public function cards()
    {
        return $this->belongsToMany('App\Card', 'cards_and_cards', 'parent_id', 'child_id');
    }
    
    /**
     * The cards in the pool that belong to the card.
     */
    public function pool()
    {
        return $this->belongsToMany('App\Card', 'card_pools', 'parent_id', 'child_id');
    }
    
    /**
     * The links that belong to the card.
     */
    public function links()
    {
        return $this->belongsToMany('App\Link', 'card_lists', 'parent_id', 'child_id');
    }
    
    /**
     *  Get the pocket associated with pocket cards.
     */
    public function pocket()
    {
        return $this->hasOne('App\Pocket', 'card_id', 'id');
    }
    
    /**
     *  Get the snippets associated with pocket cards.
     */
    public function snippets()
    {
        return $this->belongsToMany('App\Snippet', 'pockets_and_snippets', 'pocket_id', 'snippet_id');
    }
    
    /**
     *  Get the snippet associated with snippet cards.
     */
    public function snippet()
    {
        return $this->hasOne('App\Snippet', 'card_id', 'id');
    }
    
    
}
