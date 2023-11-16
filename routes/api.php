<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Authors Routes */
Route::get('authors', [AuthorController::class, 'index']);
Route::get('author/{id}', [AuthorController::class, 'show']);
Route::post('author/store', [RegisteredUserController::class, 'store']);
Route::post('author/{id}/update', [AuthorController::class, 'update']);
Route::post('author/{id}/destroy', [AuthorController::class, 'destroy']);

/* Posts Routes */
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/search', [PostController::class, 'search']);
Route::get('post/{id}', [PostController::class, 'show']);
Route::post('post/store', [PostController::class, 'store']);
Route::post('post/{id}/update', [PostController::class, 'update']);
Route::post('post/{id}/destroy', [PostController::class, 'destroy']);

/* Comments Routes */
Route::get('comments', [CommentController::class, 'index']);
Route::post('comments/export', [CommentController::class, 'export']);
Route::post('comment/store', [CommentController::class, 'store']);
Route::post('comment/{id}/destroy', [CommentController::class, 'destroy']);