<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuneralCertifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'letters_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'rtrw',
        'kelurahan',
        'kecamatan',
        'agama',
        'tanggal_meninggal',
        'tempat_pemakaman',
        'tanggal_dimakamkan',
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