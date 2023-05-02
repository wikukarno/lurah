<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SKP extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_keterangan_pemakaman';
    protected $primaryKey = 'id_surat_keterangan_pemakaman';
    protected $guarded = [
        'id_surat_keterangan_pemakaman'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function userDetails()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letters_id', 'id');
    }

}
