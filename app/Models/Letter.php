<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_surat',
    ];

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
