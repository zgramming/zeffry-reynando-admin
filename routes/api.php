<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ZeffryReynando\PortfolioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('menu/get_menu_by_modul/{id_modul}', [MenuController::class, 'getMenuByModul']);

Route::post("portfolio/upload_image_preview/{portfolio_id}", [PortfolioController::class, 'addImagePreview']);
Route::post("portfolio/delete_image_preview/{portfolio_id}", [PortfolioController::class, 'removeImagePreview']);
