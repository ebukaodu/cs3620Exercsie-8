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


Route::get('/', [
    'uses' => 'ItemController@getIndex',
    'as'   => 'onlineShop.index'
]);

Route::get('item/{id}', [
    'uses' => 'ItemController@getItem',
    'as' => 'onlineShop.item'
]);

Route::get('item/{id}/like', [
    'uses' => 'ItemController@getLikeItem',
    'as' => 'onlineShop.item.like'
]);

Route::get('story', function () {
    return view('about.story');
})->name('about.story');

Route::group(['prefix' => 'admin'], function() {
    Route::get('', [
        'uses' => 'ItemController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'ItemController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::item('create', [
        'uses' => 'ItemController@itemAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'ItemController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'ItemController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::item('edit', [
        'uses' => 'ItemController@itemAdminUpdate',
        'as' => 'admin.update'
    ]);

});
Auth::routes();

Route::item('login', [
    'uses' => 'SigninController@signin',
    'as'   => 'auth.signin'
]);
