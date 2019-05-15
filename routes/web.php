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

set_time_limit(3600);

/*
	laravel.com/docs/5.6/routing#route-parameters
*/

//clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::group(['middleware' => 'fw-block-blacklisted'], function () {
if(env('API_URI') == 'backofficeapi.bayusyaits.com' && env('API_PREFIX') == 'api'){
	$api = app('Dingo\Api\Routing\Router');
    require base_path('routes/v1.php');
    require base_path('routes/firewall.php');
    Auth::routes();
}
});