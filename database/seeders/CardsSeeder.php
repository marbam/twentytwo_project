<?php

namespace Database\Seeders;

use DB;
use App\Models\Assign\Card;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $to_truncate = ['card_types', 'cards', 'cards_type_pivot', 'game_card_types_pivot'];
        foreach($to_truncate as $table) {
            DB::table($table)->truncate();
        }

        DB::table('card_types')->insert(['name' => 'Scenarios',             'order' => 1]);
        DB::table('card_types')->insert(['name' => 'One Moon',              'order' => 2]);
        DB::table('card_types')->insert(['name' => 'Two Moons',             'order' => 3]);
        DB::table('card_types')->insert(['name' => 'Three Moons',           'order' => 4]);
        DB::table('card_types')->insert(['name' => 'Four Moons',            'order' => 5]);
        DB::table('card_types')->insert(['name' => 'Two Rooms and a Boom',  'order' => 6]);

        $gameTypes = DB::table('gametypes')->get();
        $cardTypes = DB::table('card_types')->get();

        // TODO: Scenarios

        // One Moons to start?
        $ones = [
            'Alpha Wolf', 'Pack Wolf', 'Wolf Pup', 'Defector',
            'Clairvoyant', 'Medium', 'Wizard', 'Witch', 'Healer',
            'Farmer', 'Farmer', 'Priest', 'Sinner', 'Monk',
            'Hermit', 'Jester', 'Madman', 'Innkeeper', 'Bard'
        ];
        $this->add_cards($ones, "One Moon");

        $twos = [
            'Vampire', 'Igor', 'Vampire Hunter',
            'Lawyer', 'Mayor', 'Merchant', 'Preacher', 'Seducer',
            'Assassin', 'Corrupt Guard', 'Guild Master', 'Thief', 'Spy',
            'Guard', 'Guard',
            'Juliet', 'Guardian Angel'
        ];
        $this->add_cards($twos, "Two Moons");

        $threes = [
            'Pestilent', 'Undertaker', 'Poacher', 'Vagrant',
            'Inquisitor', 'Executioner', 'Templar',
            'Hag', 'Outcast Wolf', 'Lone Wolf', 'Necromancer',
            'Nosferatu', 'Possessed'
        ];
        $this->add_cards($threes, "Three Moons");

        // Add the game to card types to help with setup:
        $one_moons = $gameTypes->whereIn('label',
        ['1 Moon/Beginner Werewolf',
        'Standard Werewolf',
        'Scenarios plus Standard']);
        $one_moon_cards_id = $cardTypes->where('name', 'One Moon')->first()->id;

        foreach($one_moons as $gt) {
            DB::table('game_card_types_pivot')
              ->insert(['game_type_id' => $gt->id, 'card_type_id' => $one_moon_cards_id]);
        }

        // Add the game to card types to help with setup:
        $standard = $gameTypes->where('label', 'Standard Werewolf')->first();
        $two_moon_cards_id = $cardTypes->where('name', 'Two Moons')->first()->id;
        $three_moon_cards_id = $cardTypes->where('name', 'Three Moons')->first()->id;

        DB::table('game_card_types_pivot')
            ->insert(['game_type_id' => $standard->id, 'card_type_id' => $two_moon_cards_id]);

        DB::table('game_card_types_pivot')
            ->insert(['game_type_id' => $standard->id, 'card_type_id' => $three_moon_cards_id]);
    }

    protected function add_cards($names, $card_type_name) {
        foreach ($names as $name) {
            $card = Card::create(['name' => $name]);
            $type_id = DB::table('card_types')->where('name', $card_type_name)->first()->id;
            DB::table('cards_type_pivot')->insert(['card_id' => $card->id, 'card_type_id' => $type_id]);
        }
    }
}
