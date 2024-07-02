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
        'paymentID',
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
}