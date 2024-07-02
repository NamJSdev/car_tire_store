<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderAndProduct extends Pivot
{
    protected $table = 'OrderAndProduct';

    protected $fillable = [
        'orderID',
        'productID',
        'soLuong',
        'thanhTien',
    ];
}