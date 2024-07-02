<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'AccountID', 'message', 'read','created_at'
    ];

    public function user()
    {
        return $this->belongsTo(Account::class);
    }
    public function markAsRead()
    {
        $this->read = true;
        $this->save();
    }

}