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

Route::group(['middleware'=>'web'], function() {

    Route::get('/', ['as'=>'index', 'uses'=>'IndexController@show']);

    Route::get('/about', ['as'=>'about', 'uses'=>'AboutController@show']);
    Route::post('/about', ['as'=>'about_rev', 'uses'=>'AboutController@review']); // комментарий

    Route::get('/menu', ['as'=>'menu', 'uses'=>'MenuController@show']);
    Route::post('/menu', ['as'=>'add_product', 'uses'=>'MenuController@add']); // добавить в корзину

    Route::get('/table', ['as'=>'table', 'uses'=>'TableController@show']);
    Route::post('/table', ['as'=>'table_res', 'uses'=>'TableController@reserve']); // бронь столика

    Route::get('/event', ['as'=>'event', 'uses'=>'EventController@show']);
    Route::post('/event', ['as'=>'event_res', 'uses'=>'EventController@reserve']); // зарезервировать мероприятие

    Route::resource('/cart', 'CartController', ['only' => ['index', 'store']]);

    Route::group(['middleware'=>'auth'], function() {

        Route::get('/profile', ['as'=>'profile', 'uses'=>'ProfileController@show']);
        Route::post('/profile', ['as'=>'update_profile', 'uses'=>'ProfileController@update']);

        Route::group(['prefix'=>"manage"], function() {
            Route::resources([
                 'news' => 'NewsController',
                 'branches' => 'BranchesController',
                 'menu' => 'MenuManageController',
                 'awards' => 'AwardsController',
                 'staff' => 'StaffController',
                 'reviews' => 'ReviewsController',
                 'orders' => 'OrdersController',
                 'reservations' => 'ReservationsController',
                 'events' => 'EventsController'
            ]);
        });
    });
});





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
