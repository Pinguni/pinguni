<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamblePrompt extends Model
{
    /**
     * Scope a query to only include prompts of a given visibility.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfVisibility($query, $type)
    {
        return $query->where('visibility', $type);
    }
}
