<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\UserController;
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


Auth::routes();


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::delete('/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
    });
    Route::group(['prefix' => 'visits'], function () {
        Route::get('/', [App\Http\Controllers\VisitController::class, 'index'])->name('visits');
        Route::delete('/{id}', [App\Http\Controllers\VisitController::class, 'delete'])->name('visits.delete');
        Route::get('/users', [App\Http\Controllers\VisitController::class, 'users'])->name('visits.users');
    });
// fake pages to test the creations of visit
    Route::group(['prefix' => 'pages', 'middleware' => ['visitCount']], function () {
        Route::get('/1', [App\Http\Controllers\PageController::class, 'pageOne']);
        Route::get('/2', [App\Http\Controllers\PageController::class, 'pageTow']);
    });
});
