<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'roleID',
        'infoID',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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