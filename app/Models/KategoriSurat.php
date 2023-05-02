<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriSurat extends Model
{
    use HasFactory, SoftDeletes;

    // proteksi nama tabel dan primary key
    protected $table = 'kategori_surat';
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


}
