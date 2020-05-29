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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'AppController@dashboard')->name('dashboard');

Route::get('/phpinfo', 'AppController@infophp')->name('phpinfo');


//Route::get('phpinfo', function(){
//	return view('pages.php-info');
//})->name('phpinfo');