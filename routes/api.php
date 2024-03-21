<?php

use App\Http\Controllers\API\V1\ArtistController;
use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\LPController;
use App\Http\Controllers\API\V1\SongAuthorController;
use App\Http\Controllers\API\V1\SongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// define a route named password.reset for Laravel Fortify needs. This route doesn't need to return anything
Route::post('/api/password/reset')->name('password.reset');

//login route to get the token
Route::post('/login', [LoginController::class, 'createToken']);

//API Model Routes
Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {

    //Artist
    Route::resource('artist', ArtistController::class);

    //Author
    Route::resource('author', AuthorController::class);

    //LP
    Route::resource('lp', LPController::class);

    //Song
    Route::resource('song', SongController::class);

    //SongAuthor
    Route::resource('song_author', SongAuthorController::class);
});
