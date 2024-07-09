<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'maDonHang',
        'desc',
        'price',
        'customerID',
        'accountID',
        'cash',
        'payCash',
        'tienNo',
        'ngayTao',
        'capNhat',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'OrderAndProduct', 'orderID', 'productID')
                    ->withPivot('soLuong', 'thanhTien');
    }

    public function warranties()
    {
        return $this->hasMany(Warranty::class, 'orderID');
    }

    public static function generateUniqueMaDonHang()
    {
        // Lấy mã hàng lớn nhất hiện tại trong cơ sở dữ liệu có dạng "DH" và 5 số
        $lastMaHang = self::where('maDonHang', 'like', 'DH%')
            ->orderBy('maDonHang', 'desc')
            ->first();

        if ($lastMaHang) {
            // Tách phần số từ mã hàng lớn nhất
            $lastNumber = (int) substr($lastMaHang->maDonHang, 2);

            // Tạo mã hàng mới với số lớn hơn một
            $newNumber = $lastNumber + 1;

            // Định dạng mã hàng mới với 5 số, thêm phần đầu "SP"
            $newMaHang = 'DH' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        } else {
            // Nếu không có mã hàng nào, bắt đầu từ "SP00001"
            $newMaHang = 'DH00001';
        }

        return $newMaHang;
    }
}