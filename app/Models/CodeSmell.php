<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CodeSmell extends Model
{
    protected $fillable = ['name', 'slug', 'summary', 'content'];

    public function deck(): HasOne
    {
        return $this->hasOne(Deck::class);
    }
}
