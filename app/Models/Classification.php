<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'id',
        'SettingName',
        'Module',
        'Value',
        'Description',
        'isActive',
        'CreatedUserBy',
        'Remarks'
    ];
}
