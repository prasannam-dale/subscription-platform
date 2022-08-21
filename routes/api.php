<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserWebsiteController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsitePostController;
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

Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::post('user', [UserController::class, 'store'])->name('user.store');

Route::get('website', [WebsiteController::class, 'index'])->name('website.index');
Route::post('website', [WebsiteController::class, 'store'])->name('website.store');

Route::get('websites/{id}/subscribe', [UserWebsiteController::class, 'index'])->name('user-website.index');
Route::post('user-website', [UserWebsiteController::class, 'store'])->name('user-website.store');

Route::get('post', [WebsitePostController::class, 'index'])->name('post.index');
Route::get('post/{websitePost}', [WebsitePostController::class, 'show'])->name('post.show');
Route::post('post', [WebsitePostController::class, 'store'])->name('post.store');
