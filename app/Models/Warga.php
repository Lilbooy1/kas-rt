<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'no_rumah',
        'alamat',
        'no_hp',
        'status'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke iuran
    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }
}