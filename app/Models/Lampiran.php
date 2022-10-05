<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'letters_id',
        'lampiran'
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letters_id', 'id');
    }
}
