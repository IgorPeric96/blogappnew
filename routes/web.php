<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::resource('/posts', 'App\Http\Controllers\PostsController');
Route::resource('/auth', 'App\Http\Controllers\AuthController');
Route::resource('/tags', 'App\Http\Controllers\TagController');
Route::resource('/comments', 'App\Http\Controllers\CommentsController');

//auth route

Route::middleware('notauthentificated')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});

 //middleware ce se pozvati pre showlogin

Route::middleware('authentificated')->group(function(){
    Route::get('/logout', [AuthController::class, 'destroy']);
Route::get('/createpost', [PostsController::class, 'createPost']);
});





//comments route

// Route::post('/createcomment', [CommentsController::class, 'store']);
// Route::post('/deletecomment/{id}', [CommentsController::class, 'destroy']);