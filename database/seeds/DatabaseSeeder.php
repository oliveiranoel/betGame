<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nickname' => 'noel',
            'email' => 'noel.oliveira@bbzsogr.ch',
            'password' =>  Hash::make('test05'),
            'admin' => true
        ]);

        User::create([
            'nickname' => 'domi',
            'email' => 'dominik.suter@bbzsogr.ch',
            'password' =>  Hash::make('test05'),
            'admin' => true
        ]);

        User::create([
            'nickname' => 'test',
            'email' => 'test@test.ch',
            'password' =>  Hash::make('test05'),
            'admin' => false
        ]);

        Team::create([
            'name' => 'Schweiz',
            'tournamentWinner' => false
        ]);

        Team::create([
            'name' => 'Portugal',
            'tournamentWinner' => false
        ]);
    }
}
