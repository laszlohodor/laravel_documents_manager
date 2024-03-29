<?php

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

Route::get('/index', function () {
    return view('index');
});

Route::get('/', 'CategoryController@MainCategory');

Route::get('/{id}', 'CategoryController@CategoryDocument');

Route::post('/newcat', 'CategoryController@NewMainCategory');

Route::post('/subcat', 'CategoryController@NewSubCatOrChangeCatName');

Route::post('/fileupload', 'DocumentController@FileUpload');

Route::post('/download', 'DocumentController@FileDownload');

Route::post('/delete', 'DocumentController@FileDelete');

Route::get('/welcome', function () {
    return view('welcome');
});

