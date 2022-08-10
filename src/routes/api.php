<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Settings\ScriptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/currencies', [CurrencyController::class, 'index']);

Route::get('/settings/script', [ScriptController::class, 'index']);

Route::post('/settings/script', [ScriptController::class, 'store']);
