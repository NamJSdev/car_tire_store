<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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
        'thoiGianBaoHanh',
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

    public static function generateUniqueMaHang()
    {
        do {
            // Sinh mã ngẫu nhiên với phần đầu là "MH" và phần sau là các số ngẫu nhiên
            $maHang = 'SP' . mt_rand(10000000, 99999999);
        } while (self::where('maHang', $maHang)->exists());

        return $maHang;
    }
}