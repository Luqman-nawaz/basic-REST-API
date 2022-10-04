<?php

use App\Http\Controllers\UsersController;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Models\quotes;
use App\Models\User;

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

Route::post('/register', [UsersController::class, 'register']);

Route::post('/login', [UsersController::class, 'authenticate']);

Route::get('/users', [UsersController::class, 'index']);

Route::get('/quotes', function(){
    return new QuoteResource(quotes::all());
});

Route::PUT('/user/api/edit', [UsersController::class, 'store']);

Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});
