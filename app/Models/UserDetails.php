<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'nik',
        'phone',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'rtrw',
        'kelurahan',
        'kecamatan',
        'agama',
        'status_perkawinan',
        'address',
        'avatar',
        'ktp',
        'kk',
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
}
