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
// ini_set('session.gc_maxlifetime', env('SESSION_TIMEOUT', 1200));
// define('env', env('APP_ENV'));
// define('env_bo', env('BACKOFFICE'));
// define('DATETIME', date('Y-m-d H:i:s'));
// define('REQUEST_SCHEME', 'http');
// define('DATE', date('Y-m-d'));
// define('TIME', time());
// define('JT', 1000000);

$api = app('Dingo\Api\Routing\Router');
/*
    laravel.com/docs/5.6/routing#route-parameters
*/
/*
Route::get('/', 
    [
        'uses'                 => 'Frontend\AppController@getIndex',
        'as'                   => 'index'
    ]
);
*/
/*

Route::match(['get','post'],'/exceptions',
    [
        'uses'                => 'Exceptions\ExceptionsController@index',
        'as'                  => 'api_404'
    ]
);
*/

/*
Route::get('/carbon', function () {
    $before = Carbon\Carbon::now();

    sleep(3);

    $now = Carbon\Carbon::now();

    return $now->diffInSeconds($before); // returns 0
});
*/

//clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
/*
Route::get('/test', function() {
    $data = [];
    $data['hostname'] = 'bayusyaits.com';
    return getClientDataApi($data);
});
*/

require base_path('routes/firewall.php');
if(env('API_URI')== 'backoffice-api.bayusyaits.com' && env('API_PREFIX') == 'api'){
    require base_path('routes/v1.php');
}
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
