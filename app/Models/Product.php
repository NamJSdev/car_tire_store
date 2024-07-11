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
        // Lấy mã hàng lớn nhất hiện tại trong cơ sở dữ liệu có dạng "SP" và 5 số
        $lastMaHang = self::where('maHang', 'like', 'SP%')
            ->orderBy('maHang', 'desc')
            ->first();

        if ($lastMaHang) {
            // Tách phần số từ mã hàng lớn nhất
            $lastNumber = (int) substr($lastMaHang->maHang, 2);

            // Tạo mã hàng mới với số lớn hơn một
            $newNumber = $lastNumber + 1;

            // Định dạng mã hàng mới với 5 số, thêm phần đầu "SP"
            $newMaHang = 'SP' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có mã hàng nào, bắt đầu từ "SP00001"
            $newMaHang = 'SP00001';
        }

        return $newMaHang;
    }
}