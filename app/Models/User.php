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
    //Funciona
    public function type()
    {
        return $this->belongsTo(UserType::class,'user_type_id', 'id');
    }
    public function artworks()
    {
        return $this->hasMany(artworks::class, 'creator', 'id');
    }

    //Funciona
    public function characters()
    {
        return $this->hasMany(characters::class, 'creator', 'id');
    }

    //Funciona
    public function rating()
    {
        return $this->belongsToMany(artworks::class, 'ratings', 'user', 'artwork')
            ->withPivot('rating');
    }

    //Funciona
    public function reviews()
    {
        return $this->belongsToMany(artworks::class, 'reviews', 'user', 'artwork')
            ->withPivot('content', 'read', 'reported');
    }

    //Funciona
    public function location()
    {
        return $this->hasMany(locations::class, 'creator', 'id');
    }

    //Funciona
    public function house() {
        return $this->belongsToMany(houses::class,'members', 'user', 'house',);
    }

//      relaciones de seguidores (se agregarán en la versión 2)
    /*public function follows()
    {
        return $this->hasMany(followers::class);
    }
    public function creator()
    {
        return $this->belongsTo(followers::class);
    }*/
}
