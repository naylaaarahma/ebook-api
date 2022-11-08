<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('me', [AuthController::class, 'me']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::get('/Author', [AuthorController::class, 'index']);
Route::get('/Author/{id}', [AuthorController::class, 'show']);

//protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('books', BookController::class)->except('create', 'edit', 'show', 'index');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('author', AuthController::class)->except('create', 'edit', 'show', 'index');
});

// Route::get('me', [AuthController::class, 'me']);
// Route::get('/books', [BookController::class, 'index']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::post('/books', [BooksController::class, 'store']);
// Route::put('/books/{id}', [BookController::class, 'update']);
// Route::delete('/books/{id}', [BookController::class, 'destroy']);
// Route::resource('books', BookController::class)->except(
//     ['create','edit']
// );

//Route::delete('books/{id}', [BookController::class, 'destroy']);
// Route::resource('author', AuthorController::class)->except(
//    ["create", "edit"]
//);

//protected routes
//Route::middleware('auth:sanctum')->group(function (){
//    Route::resource('books', BookController::class)->except(
//        ['create', 'edit', 'index', 'show']
//    );
//});