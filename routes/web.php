<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::controller(\App\Http\Controllers\Posts::class)->group(function () {
        Route::get('/posts', 'index')->name('lists.posts');
        Route::get('/posts/new', function () {
            return view('Posts.newposts');
        })->name('new.posts');
        Route::get('/posts/edit/{id}', function () {
            return view('Posts.editposts');
        })->name('post.edit');

    });

});

