<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

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
Route::POST('/register',[UserController::class,'register']);

Route::POST('/login',[UserController::class,'login']);

Route::POST("admin/add_books",[BookController::class,'addUserBooks']);

Route::get("admin/get_books/{id}",[BookController::class,'getBooks']);

Route::post('admin/update/{id}',[BookController::class,'update']);

// Route::delete('admin/book/delete/{id}',[BookController::class,'deleteBook']);

Route::post('/book/{id}',[BookController::class,'deleteBook']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
