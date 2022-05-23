<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'detail', 'amount', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
