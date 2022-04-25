<?php

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

// questo file è responsabile di servire le chiamate API di laravel, e tutte le rotte qui
// contenute hanno prefisso /api, quindi per ogni chiamate /api laravel controlla questo
// file alla ricerca di una rotta

// rotta /api/posts
Route::get('/posts', 'Api\PostController@index');
// rotta /api/posts/*
Route::get('/posts/{slug}', 'Api\PostController@show');
// Route::resource per gestire tutte le funzioni CRUD
// in questo caso in Api\PostController abbiamo solo la index e la show, quindi basta una get