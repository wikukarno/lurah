<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SKU extends Model
{
    use HasFactory, SoftDeletes;

    // proteksi nama tabel dan primary key
    protected $table = 'surat_keterangan_usaha';
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

    // relasi ke tabel user
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    // relasi ke tabel laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id');
    }
}
