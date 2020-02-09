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

// TOP画面に戻る
Route::get('/' , 'OshiInfoController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/oshi_register', 'OshiInfoController@create')->name('create');
    Route::post('/oshi_register/store', 'OshiInfoController@store')->name('store');
	// タスク編集画面遷移
	Route::get('/oshi_edit/{id}' , 'OshiInfoController@edit')->name('edit');
	// タスク更新
	Route::post('/delete/{id}' , 'OshiInfoController@delete')->name('delete');
	// タスク更新
	Route::post('/update/{id}' , 'OshiInfoController@update')->name('update');
	//Route::get('/oshi_show/{id}/twitter', 'TwitterController@index')->name('get_twitter');
	Route::get('/oshi_show/{id}', 'OshiInfoController@show')->name('show');
	Route::get('/schedule/show/','OshiScheduleController@getSchedule')->name('show_schedule');
	Route::post('/schedule/create','OshiScheduleController@postSchedule')->name('create_schedule');
	Route::get('/schedule/','OshiScheduleController@index')->name('index_schedule');
	Route::post('/schedule/update','OshiScheduleController@updateSchedule')->name('update_schedule');
	Route::get('/schedule/delete/{id}' , 'OshiScheduleController@delete')->name('delete_schedule');
});




