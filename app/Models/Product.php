<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'maHang',
        'tenHang',
        'image',
        'donViTinh',
        'giaBan',
        'giaVon',
        'tonKho',
        'luongBan',
        'desc',
        'thueID',
        'categoryID',
        'status',
        'warrantyStatus',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'OrderAndProduct', 'productID', 'orderID')
                    ->withPivot('soLuong', 'thanhTien');
    }

    public function warranties()
    {
        return $this->hasMany(Warranty::class, 'productID');
    }
}