<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
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

//Post
//TODO добавить аватарку юзера
Route::get('/post', [PostController::class, 'index']);

//TODO сделать проверку категории при сиздании поста, если такой категории нет то вывести ошибку
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/post', [PostController::class, 'store']);
    Route::put('/post/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);

//Profile
    Route::get('/profile', [UserProfileController::class, 'index']);
    Route::put('/profile', [UserProfileController::class, 'update']);


//Chat
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/chat/{idChat}', [ChatController::class, 'show']);

//Friend
//TODO сделать добавление друга и удаление друга работает по принципу
//  /friend/1  - для текущего пользователя добавить/удалить запись где friend_user_id = 1
    Route::get('/friend', [FriendController::class, 'index']);
    Route::delete('/friend/{userId}', [FriendController::class, 'destroy']);

//Friend request
    Route::get('/friend_request', [FriendRequestController::class, 'index']);
    Route::post('/friend_request/{userFriendId}', [FriendRequestController::class, 'store']);

//Category
    Route::get('/category', [CategoryController::class, 'index']);
});
//Message todo изменить маршрут  /chat/{idChat} на /chat/{idChat}/message
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/chat/{idChat}/message', [MessageController::class, 'index']);
    Route::post('/chat/{idChat}/message', [MessageController::class, 'store']);
    Route::delete('/message/{id}', [MessageController::class, 'destroy']);
    Route::post('/message/read_messages', [MessageController::class, 'readMessages']);
});

//Функционал AUTH
Route::post('/login', [UserController::class, 'login']);
Route::post('/signup', [UserController::class, 'signup']);
Route::middleware(['auth:sanctum'])->group(function () {
    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/logout', [UserController::class, 'logout']);
});
Route::middleware('auth:sanctum')->get('/user_auth', function (Request $request) {
    return $request->user();
});






