<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * Get all of the Coins for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Coins(): HasMany
    {
        return $this->hasMany(Coin::class);
    }

    /**
     * Get all of the CoinTransactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CoinTransactions(): HasMany
    {
        return $this->hasMany(CoinTransactions::class);
    }

    /**
     * Get all of the Experiences for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get all of the ExperienceTransactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ExperienceTransactions(): HasMany
    {
        return $this->hasMany(ExperienceTransaction::class);
    }
}
