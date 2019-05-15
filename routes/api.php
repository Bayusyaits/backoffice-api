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

Route::group(['middleware' => ['api','cors']], function () {
    // Route::post('auth/login', 'API/PostController@do_signin');
    Route::group(['middleware' => 'jwt.auth'], function () {
        // Route::get('user', 'PostController@getAuthUser');
    });
});


Route::group(['middleware'=>'auth.api'], function() {
	Route::post('get-details','API\PassportController@getDetails');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return 'halo';
});

// Route::get('/auth/token','API\TokenController@auth');
Route::get('/token','API\TokenController@token');
// Route::post('/pages', function(Request $request) {
// 	return response()->json(['data' => 'token']);
// });
Route::get('/create', function(Request $request) {
	return response()->json(['data' => 'token']);
});