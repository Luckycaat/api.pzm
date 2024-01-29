<?php

use App\Http\Controllers\Pokemon\PokemonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PokemonController::class, 'index']);
Route::resource('pokemon', PokemonController::class, ['names' => 'pokemon'])->except(['index']);
Route::get('/generate', [PokemonController::class, 'generate'])->name('pokemon.generate');
