<?php

namespace App\Models;

use App\Traits\HasSelections;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory, HasSelections;

    protected $table = 'branch';

    protected $fillable = [
        'id',
        'BranchCode',
        'Name',
        'SysBranchId',
        'SysBranchCode',
        'Email',
        'MobileNo',
        'Status',
        'CreatedBy',
        'UpdatedBy',
        'BrandName',
        'BrandCode',
        'TIN',
        'POC',
        'StoreRepEmail',
        'AOMEmail',
        'HeadChefEmail',
        'DirOpsEmail',
        'VPOpsEmail',
        'Address'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
