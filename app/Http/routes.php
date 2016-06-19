<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/tasks', 'HomeController@tasks');
    Route::get('/paging', 'HomeController@paging');
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    /*
    $api->get('/', function() {
        return ['Tasks' => 'Everything you need to do!'];
    });
    */

    // REST Tasks
    $api->get('tasks', 'App\Http\Controllers\TasksController@index');
    $api->get('tasks/{id}', 'App\Http\Controllers\TasksController@show');

    // JWT Auth
    $api->post('authenticate', 'App\Http\Controllers\AuthenticateController@authenticate');
    $api->post('logout', 'App\Http\Controllers\AuthenticateController@logout');
    $api->get('token', 'App\Http\Controllers\AuthenticateController@getToken');
});

// Authnticated API Calls
$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
    // Auth User
    $api->get('authenticated_user', 'App\Http\Controllers\AuthenticateController@authenticatedUser');

    // REST Tasks storage
    $api->post('tasks', 'App\Http\Controllers\TasksController@store');
    $api->delete('tasks/{id}', 'App\Http\Controllers\TasksController@destroy');
});

/*
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::resource('tasks', 'TasksController', ['except' => ['create', 'edit']]);
});
*/
