<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class artworks extends Model
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
        'title',
        'synopsis',
        'creator',
        'type',
        'genere',
        'location_id',
        'character_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(types::class);
    }
    public function genere()
    {
        return $this->belongsTo(generes::class);
    }
    public function location()
    {
        return $this->belongsTo(locations::class);
    }
    public function rating()
    {
        return $this->hasMany(ratings::class);
    }
    public function comment()
    {
        return $this->hasMany(comments::class);
    }

}
