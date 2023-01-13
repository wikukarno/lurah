<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
