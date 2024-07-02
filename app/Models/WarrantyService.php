<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'warrantyID',
        'serviceDate',
        'desc',
        'cost',
        'status',
    ];

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warrantyID');
    }
}