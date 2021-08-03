<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = "games";
    protected $filable = ["name","status"];


    public function attributes()

    {
        return $this->hasOne(GameAttribute::class,'game_id');
    }
}


