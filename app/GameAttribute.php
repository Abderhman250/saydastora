<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameAttribute extends Model
{
    protected $table = "game_attributes";
    protected $filable = ["game_id","attempts","ads_count","points_per_try"];
}
