<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class locations extends Model
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
        'fundation',
        'description',
        'creator'
    ];

    //Funciona
    public function artworks()
    {
        return $this->hasMany(artworks::class, 'location_id', 'id');
    }

    //Funciona
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }
}
