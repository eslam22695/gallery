<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumImageController;

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
    return redirect()->route('albums.index');
});

/**
 * Album Action
 */
Route::resource('/albums', AlbumController::class);
Route::get('albums/delete/{album}', [AlbumController::class, 'delete_page'])->name('albums.delete_page');
Route::post('albums/{album}/transfer_image', [AlbumController::class, 'transfer_image'])->name('albums.transfer_image');

/** End */

/**
 * Album Images Action
 */
Route::post('albums/{album}/upload', [AlbumImageController::class, 'store'])->name('album.image.store');
Route::delete('/albums/image/{image}', [AlbumImageController::class, 'destroy'])->name('album.image.destroy');

/** End */