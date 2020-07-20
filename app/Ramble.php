<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ramble extends Model
{
    /**
     * Get the prompt that owns the ramble entry.
     */
    public function prompt()
    {
        return $this->belongsTo('App\RamblePrompt', 'prompt_id');
    }
}
