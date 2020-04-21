<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'game_id', 'score1', 'score2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public static function bet ($gameid) {
        $list = Bet::where([
            ['user_id', Auth::user()->id],
            ['game_id', $gameid],
        ])->get();
        return $list->count() > 0 ? $list[0] : null;
    }
}
