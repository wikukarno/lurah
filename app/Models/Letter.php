<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'jenis_surat',
        'nomor_surat',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'agama',
        'status_perkawinan',
        'no_nik',
        'nama_usaha',
        'alasan_penolakan',
        'posisi',
        'status',
        'hari_meninggal',
        'tanggal_meninggal',
        'nama_pemakaman',
        'tanggal_dimakamkan',
        'tujuan_surat_tidak_mampu',
        'perihal',
        'tujuan_surat_izin',
        'nama_izin',
        'tanggal_pelaksanaan_izin',
        'tempat_pelaksanaan_izin',
        'waktu_pelaksanaan_izin',
        'jumlah_undangan',
        'hiburan',
        'ktp',
        'kk',
        'surat_rt_rw'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
