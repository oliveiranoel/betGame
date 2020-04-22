<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tournamentWinner'
    ];


    public function users() {
        return $this->belongsToMany(User::class, 'tournament_bets');
    }

    public function games() {
        return $this->hasMany(Game::class);
    }
}
