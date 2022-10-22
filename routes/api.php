<?php

use App\Http\Controllers\QuotesController;
use App\Http\Controllers\UsersController;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Models\quotes;
use App\Models\User;
use League\CommonMark\Extension\SmartPunct\Quote;

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

//Auth Routes
Route::post('/register', [UsersController::class, 'register']);
Route::post('/login', [UsersController::class, 'authenticate']);


//User Routes
Route::get('/users', [UsersController::class, 'index']);
Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});


//Quote Routes
Route::get('/quotes', function(){
    return new QuoteResource(quotes::all());
});
Route::get('/quote/{id}', function($id){
    return new QuoteResource(quotes::findOrFail($id));
});