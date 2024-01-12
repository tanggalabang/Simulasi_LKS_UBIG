<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardMemberController;
use App\Http\Controllers\BoardListController;
use App\Http\Controllers\CardController;


// guest auth
Route::post('v1/auth/register', [AuthController::class, 'register']);
Route::post('v1/auth/login', [AuthController::class, 'login']);

// middleware only actor have token
Route::middleware(\App\Http\Middleware\TokenValidation::class)->group(function () {
    // guard auth
    Route::get('v1/auth/logout', [AuthController::class, 'logout']);

    // board resource
    Route::resource('v1/board', BoardController::class);

    //Unauthorized only board team member can access
    Route::middleware(\App\Http\Middleware\ActorMember::class)->group(function () {
        // board member
        Route::post('v1/board/{board_id}/member', [BoardMemberController::class, 'store']);
        Route::delete('v1/board/{board_id}/member/{actor_id}', [BoardMemberController::class, 'destroy']);

        // board list
        Route::post('v1/board/{board_id}/list', [BoardListController::class, 'store']);
        Route::put('v1/board/{board_id}/list/{list_id}', [BoardListController::class, 'update']);
        Route::delete('v1/board/{board_id}/list/{list_id}', [BoardListController::class, 'destroy']);
        Route::post('v1/board/{board_id}/list/{list_id}/right', [BoardListController::class, 'moveToRight']);
        Route::post('v1/board/{board_id}/list/{list_id}/left', [BoardListController::class, 'moveToLeft']);

        // card
        Route::post('v1/board/{board_id}/list/{list_id}/card', [CardController::class, 'store']);
        Route::put('v1/board/{board_id}/list/{list_id}/card/{card_id}', [CardController::class, 'update']);
        Route::delete('v1/board/{board_id}/list/{list_id}/card/{card_id}', [CardController::class, 'destroy']);
        Route::post('v1/card/{card_id}/up', [CardController::class, 'moveToUp']);
        Route::post('v1/card/{card_id}/down', [CardController::class, 'moveToDown']);
        Route::post('v1/card/{card_id}/move/{list_id}', [CardController::class, 'moveToAnotherList']);

    });
});

