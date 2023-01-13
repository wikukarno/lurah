<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCertifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'letters_id',
        'users_id',
        'nama_usaha',
        'jenis_usaha',
        'surat_rtrw',
        'alasan_penolakan',
        'posisi',
        'status'
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
