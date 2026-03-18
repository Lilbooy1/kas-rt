<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'warga_id',
        'bulan',
        'tahun',
        'jumlah',
        'tanggal_bayar',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}