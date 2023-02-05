<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'jenis_surat',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function business()
    {
        return $this->hasMany(BusinessCertifications::class, 'letters_id', 'id');
    }

    public function funeral()
    {
        return $this->hasMany(FuneralCertifications::class, 'letters_id', 'id');
    }

    public function incapacity()
    {
        return $this->hasMany(IncapacityCertifications::class, 'letters_id', 'id');
    }

    public function permits()
    {
        return $this->hasMany(Permits::class, 'letters_id', 'id');
    }
}
