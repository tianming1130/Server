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
//admin
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
	$router->post('register','AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('updateprofile','AuthController@updateProfile');
    $router->get('me','AuthController@me');
    
    $router->post('food/add','FoodController@add');
    $router->post('food/delete','FoodController@delete');
    $router->post('food/update','FoodController@update');
    $router->get('food/query','FoodController@query');

    $router->post('foodtype/add','FoodTypeController@add');
    $router->post('foodtype/delete','FoodTypeController@delete');
    $router->post('foodtype/update','FoodTypeController@update');
    $router->get('foodtype/query','FoodTypeController@query');

    $router->get('order/query','OrderController@query');

    $router->get('merchant/query','MerchantController@query');
});

//home
Route::group([
    'prefix' => 'home','namespace' => 'Home'
], function ($router) {
	$router->post('register','AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout','AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');

    $router->get('food/list','FoodController@getAll');


    $router->post('order/add','OrderController@add');
    $router->get('order/list','OrderController@query');
});


//merchant
Route::group([
    'prefix' => 'merchant','namespace' => 'Merchant'
], function ($router) {
    $router->post('register','AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout','AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
    $router->get('getcode','AuthController@getCode');

    // Route::get('food/list','FoodController@getAll');


    // Route::post('order/add','OrderController@add');
    // Route::get('order/list','OrderController@query');
});
// Route::get('/test','TestController@test')->middleware('auth:api');
