<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';

    protected $fillable = [
        'tanggal',
        'tujuan',
        'asal',
        'nomor',
        'perihal',
        'file',
        'status',
        'pengirim_id',
    ];

    // Relasi
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class);
    }
}
