<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IncapacityCertifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'letters_id',
        'tujuan',
        'alasan_penolakan',
        'posisi',
        'status',
        'surat_rtrw',
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
