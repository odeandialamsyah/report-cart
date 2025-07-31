<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluars';

    protected $fillable = [
        'tanggal',
        'tujuan',
        'asal',
        'nomor',
        'perihal',
        'file',
        'status',
        'petugas_id',
        'kepala_id',
    ];

    // Relasi
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
