<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'trip_id',
        'jumlah_peserta',
        'tanggal_berangkat',
        'total_harga',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'total_harga' => 'integer',
    ];

    // Relasi ke User (belongs to one user)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Trip (belongs to one trip)
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
