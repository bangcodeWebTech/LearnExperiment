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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/chart','ChartController@index')->name('chart.index');
Route::get('activity','ActivityController@index')->name('activity.index');
Route::get('activity/chart','ActivityController@activityChart')->name('activity.chart');
Route::post('activity/chart/data','ActivityController@activityChartData')->name('activity.get.chart');
Route::get('activity/download','ActivityController@export')->name('activity.download');
