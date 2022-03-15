<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends BaseModel
{
    protected $fillable = ['name'];
    protected $hidden = ['deleted_at'];


    public function Coins(): HasMany
    {
        return $this->hasMany(Coin::class);
    }

    public function Experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
}
