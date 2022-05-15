<?php

namespace App\Http\Controllers;

use App\Models\Assign\Game;
use App\Models\Assign\GameType;
use App\Models\Assign\Card;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function getGameOptions() {
        $gametypes = GameType::get();
        return view('assign.choose_type', ['types' => $gametypes]);
    }

    public function makeGame(Request $request, $id = null) {

        if (!$id) {
            $game = Game::create([
                'type_id' => $request->type_id
            ]);
        } else {
            $game = Game::findOrFail($id);
        }
        $this->setupGame($game);
    }

    public function setupGame(Game $game) {
        $type_id = $game->type_id;

        $data['available_cards'] = $this->getAvailableCards($type_id);
        $data['selected_cards'] = $this->getSelectedCards($game->id);
        $data['game_id'] = $game->id;

        $card_types_in = $data['available_cards']->pluck('card_type_id', 'card_type_id')->toArray();
        $data['cards_types'] = \DB::table('card_types')->whereIn('id', $card_types_in)->orderBy('order')->get();

        return view('assign.select_cards', ['data' => $data]);
    }

    protected function getAvailableCards($type_id) {
        return Card::join('cards_type_pivot', 'cards_type_pivot.card_id', '=', 'cards.id')
            ->where('card_type_id', $type_id)
            ->get(['cards.id', 'cards.name', 'cards_type_pivot.card_type_id']);
    }

    protected function getSelectedCards($game_id) {
        return \DB::table('selected_cards')
                 ->where('game_id', $game_id)
                 ->pluck('id')
                 ->toArray();
    }

    protected function getUnselectedCards($game_id) {
        return null;
    }

    public function submitCards(Request $request, $game_id) {

        $cardString = $request->cards;
        \DB::table('selected_cards')->where('game_id', $game_id)->delete();
        $cards = explode(",", $cardString);
        $inserts = [];
        foreach ($cards as $card_id) {
            $inserts[] = ['game_id' => $game_id, 'card_id' => $card_id, 'selected' => false];
        }
        \DB::table('selected_cards')->insert($inserts);
        return redirect('/player_cards/'.$game_id);
    }

    public function showPlayerCards($game_id) {
        // get all Available Cards
        // show them to choose
        return view('assign.player_cards');
    }

    public function choosePlayerCard($game_id, $card_id) {
        // endpoint for when a player chooses a card.
        // update the database here and then redirect back to showPlayerCards.
    }
}
