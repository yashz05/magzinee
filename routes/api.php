<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(\App\Http\Controllers\others\image_manager::class)->group(function() {
    Route::post('/image/new', 'image_upload')->name('image.upload');
    Route::get('/posts/new', function () { return view('Posts.newposts'); })->name('new.posts');

});
