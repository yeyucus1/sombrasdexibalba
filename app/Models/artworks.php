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
    //funciona
    public function author()
    {
        return $this->belongsTo(User::class,'creator', 'id');
    }

    //Funciona
    public function type()
    {
        return $this->belongsTo(types::class, 'type', 'id');
    }

    //funciona
    public function genere()
    {
        return $this->belongsTo(generes::class, 'genere', 'id');
    }


    //funciona
    public function location()
    {
        return $this->belongsTo(locations::class, 'location_id', 'id');
    }

    //Funciona
    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings', 'artwork', 'user')
            ->withPivot('rating');
    }

    //Funciona
    public function protagonist(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(characters::class, 'character_id', 'id');

    }

    //Funciona
    public function comments()
    {
        return $this->belongsToMany(User::class, 'comments', 'artwork', 'user')
            ->withPivot('content');
    }

}
