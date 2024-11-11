<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSelections
{
    public function scopeOptions(Builder $query)
    {
        return $query->select('id', 'Name')->where('status', 1)->get()->pluck('Name', 'id');
    }
}
