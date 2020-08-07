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
    return view('home');
});

Auth::routes();

Route::get('/home', 'CatalogController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
        Route::resource('/upload', 'UploadController');
        Route::post('/upload/fileupload/','UploadController@store')->name('upload.store');
        Route::resource('/catalog', 'CatalogController');
        Route::post('/catalog/item', 'CatalogUploadController@store')->name('item.store');

        // Route::get('/catalog', 'CatalogController@index')->name('catalog');
});
