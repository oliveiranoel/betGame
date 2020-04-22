<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'team1_id', 'team2_id'
    ];

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
