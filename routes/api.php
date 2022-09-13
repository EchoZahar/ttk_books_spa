<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\UploadCoverController;
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

Route::resource('sections', SectionController::class)->only('index', 'show')->names('api.sections');
Route::resource('books', BookController::class)->only('index', 'show')->names('api.books');
Route::resource('authors', AuthorController::class)->only('index', 'show');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // only admin.
    Route::controller(SectionController::class)->group(function() {
        Route::post('sections', 'store')->name('api.sections.store');
        Route::put('sections/{section}', 'update')->name('api.sections.update');
        Route::post('sections/{section}', 'destroy')->name('api.sections.destroy');
    });
    // only admin, author and user.
    Route::controller(BookController::class)->group( function () {
        Route::post('books', 'store');
        Route::put('books/{book}', 'update');
        Route::post('books/{book}', 'destroy');
    });
    Route::post('books/uploadCover', [UploadCoverController::class, 'upload']);

    // only admin and author.
    Route::controller(AuthorController::class)->group( function () {
        Route::post('authors', 'store');
        Route::put('authors/{author}', 'update');
        Route::post('authors/{author}', 'destroy');
    });

    // current auth user.
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
