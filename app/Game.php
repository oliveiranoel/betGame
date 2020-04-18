<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function team1() {
        return $this->belongsTo(Team::class);
    }

    public function team2() {
        return $this->belongsTo(Team::class);
    }
}
