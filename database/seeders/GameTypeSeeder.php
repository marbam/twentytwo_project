<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameTypes = [
            "1 Moon/Beginner Werewolf",
            "Standard Werewolf",
            "Scenarios",
            "Scenarios plus Standard",
            "Two Rooms and Boom"
        ];

        foreach ($gameTypes as $gameType) {
            DB::table('gametypes')->insert([
                'label' => $gameType
            ]);
        }
    }
}
