<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    protected $table = "user_points";
    protected $fillable = [
        'user_id', 'game_id', 'points',
    ];
}
