<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoinTransaction extends BaseModel
{
    protected $fillable = ['id', 'game_id', 'user_id', 'total'];
    protected $hidden = ['deleted_at'];

    public function Coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }
}
