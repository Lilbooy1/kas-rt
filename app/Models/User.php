<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke warga (jika setiap user punya data warga)
    public function warga()
    {
        return $this->hasOne(Warga::class);
    }

    // Relasi ke iuran
    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

    // Cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAnggota()
    {
        return $this->role === 'anggota';
    }
}