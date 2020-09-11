<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardComment extends Model
{
    // table name
    protected $table = 'card_comments';

    /**
     * The user who owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
