<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

// Route::get('categories', [CategoryController::class, 'index']);
// Route::get('categories/{category}', [CategoryController::class, 'show']);
// Route::post('categories', [CategoryController::class, 'store']);
// Route::put('categories/{category}', [CategoryController::class, 'update']);
// Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

Route::group(
    [
        'prefix' => 'categories',
        'controller' => CategoryController::class,
        'middleware' => 'jwt',
    ], static function () {
        Route::get('/', 'index');
        Route::get('/{category}', 'show');
        Route::post('/', 'store');
        Route::put('/{category}', 'update');
        Route::delete('/{category}', 'destroy');
    }
);

// Route::get('authors', [AuthorController::class, 'index']);
// Route::get('authors/{author}', [AuthorController::class, 'show']);
// Route::post('authors', [AuthorController::class, 'store']);
// Route::put('authors/{author}', [AuthorController::class, 'update']);
// Route::delete('authors/{author}', [AuthorController::class, 'destroy']);

Route::group(
    [
        'prefix' => 'authors',
        'controller' => AuthorController::class,
        'middleware' => 'jwt',
    ], static function () {
        Route::get('/', 'index');
        Route::get('/{author}', 'show');
        Route::post('/', 'store');
        Route::put('/{author}', 'update');
        Route::delete('/{author}', 'destroy');
    }
);


// Route::get('partners', [PartnerController::class, 'index']);
// Route::get('partners/{partner}', [PartnerController::class, 'show']);
// Route::post('partners', [PartnerController::class, 'store']);
// Route::put('partners/{partner}', [PartnerController::class, 'update']);
// Route::delete('partners/{partner}', [PartnerController::class, 'destroy']);


Route::group(
    [
        'prefix' => 'partners',
        'controller' => PartnerController::class,
        'middleware' => 'jwt',
    ], static function () {
        Route::get('/', 'index');
        Route::get('/{partner}', 'show');
        Route::post('/', 'store');
        Route::put('/{partner}', 'update');
        Route::delete('/{partner}', 'destroy');
    }

);

// Route::get('books',[BookController::class, 'index']);
// Route::get('books/{book}',[BookController::class, 'show']);
// Route::post('books',[BookController::class, 'store']);
// Route::put('books/{book}', [BookController::class, 'update']);
// Route::delete('books/{book}', [BookController::class, 'destroy']);

Route::group(
    [
        'prefix' => 'books',
        'controller' => BookController::class,
        // 'middleware' => 'jwt',
    ], static function () {
        Route::get('/', 'index');
        Route::get('/{book}', 'show');
        Route::post('/', 'Store');
        Route::put('/{book}', 'update');
        Route::delete('/{book}', 'destroy');
    }
);