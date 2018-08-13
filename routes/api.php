<?php

use Illuminate\Http\Request;

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

Route::get('get-items', 'ItemController@index');

Route::get('get-categories', 'CategoryController@index');
Route::get('get-items-for-category/{category}', 'CategoryController@itemsForCategory');

Route::group(['middleware' => 'api_auth'], function()
{
    Route::post('create-item', 'ItemController@create');
    Route::post('update-item/{item}', 'ItemController@update');
    Route::get('delete-item/{item}', 'ItemController@delete');

    Route::post('create-category', 'CategoryController@create');
    Route::post('update-category/{category}', 'CategoryController@update');
    Route::get('delete-category/{category}', 'CategoryController@delete');
});