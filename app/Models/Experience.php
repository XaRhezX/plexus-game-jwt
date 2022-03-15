<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Experience extends BaseModel
{
    protected $fillable = ['id', 'game_id', 'user_id', 'total'];
    protected $hidden = ['deleted_at'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function ExperienceTransactions(): HasMany
    {
        return $this->hasMany(ExperienceTransaction::class);
    }
}
