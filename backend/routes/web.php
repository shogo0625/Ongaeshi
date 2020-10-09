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

Auth::routes();

// Delete Images of Gift
Route::get('/delete-images/gift/{gift_id}', 'GiftController@deleteImages')->name('gift.delete_images');
// Delete Images of User
Route::get('/delete-images/user/{user_id}', 'UserController@deleteImages')->name('user.delete_images');
