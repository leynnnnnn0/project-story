<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productmasterfile';

    protected $fillable = [
        'ID',
        'ProductType',
        'InventoryID',
        'Barcode',
        'InventoryName',
        'Brand',
        'CategRep',
        'ClasiRep',
        'CategoryA',
        'CategoryB',
        'UOM',
        'Conversion',
        'Packaging',
        'Status',
        'CreatedBy',
        'CreatedDate',
        'UpdatedBy',
        'UpdatedDate',
        'Cost',
        'SRP1',
        'SRP2',
        'SRP3',
        'SRP4',
        'SRP5',
        'SRP6',
        'SRP7'
    ];
}
