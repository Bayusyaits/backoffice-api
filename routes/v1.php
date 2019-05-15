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
//vue.js

$api->version('v1',
	[
        'prefix'               =>  'api',
		'middleware'           =>  'cors',
		'limit'                =>  100,
		'expires'              =>  60,
		'namespace'            =>  'App\Http\Controllers'
	], 
	
    function ($api) {
        //rest controller from client
        
        $api->get('/users/registration', 
            [
                'uses'             =>   'Post\Users\RegistrationController@getUsersRegistration', 
                'as'               =>   'getUsersRegistration'
            ]
        );
        
        //post

        $api->post('/v1/{uri1}/{uri2}', 
            [
                'uses'             =>  'RestController@postApi',
                'as'               =>  'postApi'
            ]
        );

        $api->post('/users/registration', 
            [
                'uses'             =>   'Post\Users\RegistrationController@postRegistration', 
                'as'               =>   'postRegistration'
            ]
        );
        
        $api->post('/users/login', 
            [
                'uses'             =>   'Post\Users\LoginController@postLogin', 
                'as'               =>   'postLogin'
            ]
        );
        
        $api->post('/content/{uri}', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@postContentManagement', 
                'as'               =>   'postContentManagement'
            ]
        );

        $api->post('/single-page/{uri}', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@postSinglePageContent', 
                'as'               =>   'postSinglePageContent'
            ]
        );

        $api->post('/client/token', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@issueToken', 
                'as'               =>   'issueToken'
            ]
        );

        $api->post('/case-studies/{uri}', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@postContentProjects',
                'as'               =>   'postContentProjects'
            ]
        );
        
        $api->post('/portfolio/{uri}', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@postContentProjects',
                'as'               =>   'postContentProjects'
            ]
        );

        $api->post('/projects/{uri}', 
            [
                'uses'             =>   'Post\Master\MrContentManagementController@postSingleContentProject',
                'as'               =>   'postSingleContentProject'
            ]
        );

        $api->post('/related/{uri}',
        		[
        			'uses'        =>   'Post\Master\MrContentManagementController@postRelatedProject',
                	'as'          =>   'postRelatedProject'
        		]
        );
        $api->post('/pages/{uri}', 
            [
                'uses'             =>  'Post\Dyn\DynMenuController@postMenu',
                'as'               =>  'postMenu'
            ]
        );

        $api->post('/media/{uri}', 
            [
                'uses'             =>  'Post\Master\MrMediaController@postMedia',
                'as'               =>  'postMedia'
            ]
        );

        $api->post('/categories/{uri}', 
            [
                'uses'             =>  'Post\Master\MrCategoriesController@postcategories',
                'as'               =>  'postcategories'
            ]
        );

                
        //put
        $api->put('/post/{uri}',
            [
                'uses'            => 'Put\Contact\PostContactController@putMessages',
                'as'              => 'putMessages'
            ]
        );
        
        $api->put('/put/{uri}',
            [
                'uses'            => 'Put\Master\MrContentManagementController@putContentManagement',
                'as'              => 'putContentManagement'
            ]
        );
});