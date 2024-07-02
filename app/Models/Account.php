<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'roleID',
        'infoID',
    ];

    protected $hidden = [
        'password',
    ];

    public function setMatKhauAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleID');
    }

    public function info()
    {
        return $this->belongsTo(Info::class, 'infoID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'accountID');
    }
}