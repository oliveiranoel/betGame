<?php

namespace App\Rules;

use App\Team;
use Illuminate\Contracts\Validation\Rule;

class tournamentWinnerRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach (Team::all() as $team) {
            if ($team->tournamentWinner == true) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only one team can be tournament winner!';
    }
}
