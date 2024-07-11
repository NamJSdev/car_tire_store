<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'hoTen',
        'sdt',
        'gioiTinh',
        'ngaySinh',
        'diaChi',
        'email',
        'desc',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customerID');
    }
    public function orderProducts()
    {
        return $this->hasManyThrough(OrderAndProduct::class, Order::class, 'customerID', 'orderID', 'id', 'id');
    }
}