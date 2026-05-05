<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'lokasi',
        'deskripsi',
        'harga',
        'gambar',
        'durasi',
        'fasilitas',
        'status'
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'harga' => 'integer',
        'durasi' => 'integer',
    ];

    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return 'https://placehold.co/600x400/0F2B4D/white?text=' . urlencode($this->nama);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Local Scope: trip dengan harga di bawah nilai tertentu
    public function scopeHargaKurangDari($query, $harga)
    {
        return $query->where('harga', '<', $harga);
    }

    // ==================== RELASI ====================

    // Relasi ke Booking (one to many)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
