<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $fillable = ['user_id', 'deck_id', 'score', 'total_questions', 'accuracy', 'time_seconds'];

}
