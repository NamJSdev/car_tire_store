<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderID',
        'productID',
        'warrantyPeriod',
        'warrantyStart',
        'warrantyEnd',
        'terms',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }

    public function services()
    {
        return $this->hasMany(WarrantyService::class, 'warrantyID');
    }
}