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
Route::group(['prefix' => '/v1', 'namespace' => 'Api', 'as' => 'api'], function(){
    Route::post('login',['as'=>'login', 'uses'=>'UserController@login']);
    Route::post('register',['as'=>'register', 'uses'=>'UserController@register']);
    
    Route::group(['middleware'=>'auth:api'], function(){
        Route::post('details', 'UserController@detail');
        Route::resource('articles', 'ArticleController', ['except' => ['create', 'edit']]); 
        Route::get('categories/{category}/tasks', 'CategoryController@tasks');
        Route::post('tasks/sortable/{id}', 'TaskController@sortable');
        Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
        Route::resource('tasks', 'TaskController', ['except' => ['create', 'edit']]);
    });
});