<?php

namespace App\Http\Controllers;

use App\Models\Assign\Game;
use App\Models\Assign\GameType;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function getGameOptions() {
        $gametypes = GameType::get();
        return view('assign.choose_type', ['types' => $gametypes]);
    }

    public function setupGame(Request $request, $id = null) {

        if (!$id) {
            $game = Game::create([
                'type_id' => $request->type_id
            ]);
        } else {
            $game = Game::findOrFail($id);
        }

        $available_cards = $this->getAvailableCards($type_id);
        $selected_cards = $this->getSelectedCards($game->id);

        dd($game);
    }

    protected function getAvailableCards($type_id) {
        return null;
    }

    protected function getSelectedCards($game_id) {
        return null;
    }

}
