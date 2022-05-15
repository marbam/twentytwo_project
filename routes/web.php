<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateEntryController;
use App\Http\Controllers\AssignController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/dates', [DateEntryController::class, 'index']);
    Route::get('/dates/add', [DateEntryController::class, 'create_today']);
    Route::post('/dates/add', [DateEntryController::class, 'store']);

    Route::get('/dates/add/{y}/{m}/{d}', [DateEntryController::class, 'create']);
    Route::post('/dates/add/{y}/{m}/{d}', [DateEntryController::class, 'store']);
});

Route::get('/assign/game_options', [AssignController::class, 'getGameOptions']);
Route::post('/assign/setup_game',   [AssignController::class, 'makeGame']);
Route::get('/assign/setup_game/{game}',   [AssignController::class, 'setupGame']);
Route::post('/assign/submit_cards/{game}',   [AssignController::class, 'submitCards']);
Route::post('/assign/player_cards/{game}',   [AssignController::class, 'showPlayerCards']);
Route::post('/assign/choose_player_card/{game}',   [AssignController::class, 'choosePlayerCard']);

require __DIR__.'/auth.php';


