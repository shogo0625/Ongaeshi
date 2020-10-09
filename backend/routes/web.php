<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('anniversary', 'AnniversaryController');
Route::resource('gift', 'GiftController');
Route::resource('user', 'UserController');
Route::resource('gift/{gift}/gift_comment', 'GiftCommentController', ['only' => ['store', 'destroy']]);

Auth::routes();

Route::prefix('delete-images')->group(function () {
    Route::get('gift/{gift}', 'GiftController@deleteImages')->name('gift.delete_images');
    Route::get('user/{user}', 'UserController@deleteImages')->name('user.delete_images');
});
