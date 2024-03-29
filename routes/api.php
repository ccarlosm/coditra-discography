<?php

use App\Http\Controllers\API\V1\ArtistController;
use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\LPController;
use App\Http\Controllers\API\V1\SongAuthorController;
use App\Http\Controllers\API\V1\SongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// define a route named password.reset for Laravel Fortify needs. This route doesn't need to return anything
Route::post('/api/password/reset')->name('password.reset');

//API Model Routes
Route::group(['middleware' => 'auth:sanctum'], function () {

    //Return current authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json(['success' => true, 'data' => Auth::user()]);
    });

    //Artist
    Route::resource('artists', ArtistController::class);

    //Author
    Route::resource('authors', AuthorController::class);

    //LP
    Route::resource('lps', LPController::class);

    //Song
    Route::resource('songs', SongController::class);

    //SongAuthor
    Route::resource('song_authors', SongAuthorController::class);

});
