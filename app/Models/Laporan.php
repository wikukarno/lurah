<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;

    // proteksi nama tabel dan primary key
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    // nonaktifkan increment pada primary key
    public $incrementing = false;

    // set tipe primary key
    protected $keyType = 'string';

    // set default value pada kolom id
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    // relasi ke tabel kategori_surat
    public function category()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori_surat', 'id');
    }

    // relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // relasi ke tabel surat_keterangan_usaha
    public function business()
    {
        return $this->hasMany(SKU::class, 'id_laporan', 'id');
    }

    // relasi ke tabel surat_keterangan_pemakaman
    public function funeral()
    {
        return $this->hasMany(SKP::class, 'id_laporan', 'id');
    }

    // relasi ke tabel surat_keterangan_tidak_mampu
    public function incapacity()
    {
        return $this->hasMany(SKTM::class, 'id_laporan', 'id');
    }

    // relasi ke tabel surat_keterangan_izin
    public function permits()
    {
        return $this->hasMany(SKI::class, 'id_laporan', 'id');
    }
}
