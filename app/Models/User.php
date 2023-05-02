<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'tele_id',
    //     'tele_name',
    //     'tele_notif',
    //     'login_with',
    //     'login_ip',
    //     'auth_status',
    //     'status_account',
    //     'alasan_penolakan',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
    

    // public function userDetails()
    // {
    //     return $this->hasOne(UserDetails::class, 'id_user', 'id');
    // }

}
