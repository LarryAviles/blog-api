<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::get('authors', [PostController::class, 'index']);
/* Posts Routes */
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/search', [PostController::class, 'search']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::post('post/store', [PostController::class, 'store']);
Route::post('post/{id}/update', [PostController::class, 'update']);

/* Comments Routes */
Route::get('comments', [CommentController::class, 'index']);
Route::post('comments/export', [CommentController::class, 'export']);