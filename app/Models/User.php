<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'pseudonym',
        'email',
        'user_type_id',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /***
     * Relación con user_types
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(UserType::class,'user_type_id', 'id');
    }
    public function artwork()
    {
        return $this->hasMany(artworks::class);
    }
    public function character()
    {
        return $this->hasMany(characters::class);
    }
    public function rating()
    {
        return $this->hasMany(ratings::class);
    }
    public function coment()
    {
        return $this->hasMany(comments::class);
    }
    public function member()
    {
        return $this->hasMany(members::class);
    }
    public function location()
    {
        return $this->hasMany(locations::class);
    }




//      relacion de followers
    public function follow()
    {
        return $this->hasMany(followers::class);
    }
    public function follows1()
    {
        return $this->belongsTo(followers::class);
    }
}
