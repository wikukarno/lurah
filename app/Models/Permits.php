<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permits extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'letters_id',
        'perihal',
        'tujuan_surat',
        'nama_izin',
        'tanggal_izin',
        'tempat_izin',
        'waktu_izin',
        'jumlah_peserta',
        'hiburan',
        'alasan_penolakan',
        'posisi',
        'status',
        'surat_rtrw',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letters_id', 'id');
    }
}
