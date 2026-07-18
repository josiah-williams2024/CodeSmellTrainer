<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deck extends Model
{
    protected $guarded = [];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function gameResults(): HasMany
    {
        return $this->hasMany(GameResult::class);
    }

    public function codeSmell(): BelongsTo
    {
        return $this->belongsTo(CodeSmell::class);
    }
}
