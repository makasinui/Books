<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BooksController;
use App\Http\Controllers\Api\V1\AuthorsController;
use App\Http\Controllers\Api\V1\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search', [BooksController::class, 'search']);

Route::resources([
    'books' => BooksController::class
]);

Route::resources([
    'authors' => AuthorsController::class
]);

Route::resources([
    'sections' => SectionsController::class
]);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/books', [BooksController::class, 'store']);
    Route::post('/authors', [AuthorsController::class, 'store'])->middleware('auth.admin');
    Route::post('/sections', [SectionsController::class, 'store'])->middleware('auth.admin');
});
