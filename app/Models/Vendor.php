<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    protected $table = 'vendormasterfile';
    protected $fillable = [
        'name'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
