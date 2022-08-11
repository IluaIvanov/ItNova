<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Settings\ScriptController;
use App\Http\Controllers\Settings\WidgetController;
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

Route::get('/frequency', [CurrencyController::class, 'getFrequency']);

Route::get('/settings/script', [ScriptController::class, 'index']);

Route::get('/settings/widget', [WidgetController::class, 'index']);

Route::post('/settings/widget', [WidgetController::class, 'store']);

Route::post('/settings/widget/frequency', [WidgetController::class, 'createOrUpdateFrequency']);

Route::post('/settings/script', [ScriptController::class, 'store']);
