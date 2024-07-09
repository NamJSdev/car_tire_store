<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderAndProduct extends Pivot
{
    protected $table = 'order_and_product';

    protected $fillable = [
        'orderID',
        'productID',
        'soLuong',
        'thanhTien',
        'donGia',
    ];
}