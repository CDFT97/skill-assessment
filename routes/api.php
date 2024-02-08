<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Auth\AuthApiController;

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

Route::post("login", [AuthApiController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("logout", [AuthApiController::class, "logout"]);
    
    
    Route::get("/quotes/random-quotes/{quantity?}", [QuoteController::class, "randomQuotes"]);
    Route::get("/quotes/my-favorites", [QuoteController::class, "myFavorites"]);
    Route::post("/quotes/store", [QuoteController::class, "store"]);
    Route::delete("/quotes/remove/{quote_id}", [QuoteController::class, "destroy"]);
});
