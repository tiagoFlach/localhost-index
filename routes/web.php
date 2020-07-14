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

Route::get('/', 'AppController@home')->name('home');

Route::post('/listDir', 'AppController@listDir')->name('listDir');
Route::get('/listDir', 'AppController@listDir')->name('listDir');

Route::view('phpinfo', 'pages.phpinfo', [
    'page_active' => 'phpinfo'
])->name('phpinfo');