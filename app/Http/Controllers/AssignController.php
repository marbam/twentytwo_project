<?php

namespace App\Http\Controllers;

use App\Models\Assign\GameType;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function getGameOptions() {
        $gametypes = GameType::get();
        return view('assign.choose_type', ['types' => $gametypes]);
    }
}
