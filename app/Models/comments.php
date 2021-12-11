<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class comments extends Model
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
        'content',

    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [

    ];
    public function artwork()
    {
        return $this->belongsTo(artworks::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
