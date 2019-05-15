<?php

namespace App\Http\Controllers\Dyn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use dingo

use Dingo\Api\Routing\Helpers;

//guzzle client api
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

use App\Transformers\AppTransformer;
use Response;
use \Illuminate\Http\Response as Res;

use App\Rest;

use Illuminate\Support\Facades\Auth;
 
use Validator;

class DynMenuController extends Res
{
    //
    public function __construct() {

    }
	public $error = 500;
	public $successStatus = 200;
    use Helpers;

    public function getMenuContact() {
    	$dm = model('DynMenu')::menuactive()->get();
    	return URL::current();


    }

    /*
		-Method Post
    */

    public function postMenu(Request $request,$uri = '') {

        $dm =  array('status' 	=> 'Error',
                    'code' 		=> Res::HTTP_NOT_FOUND,
                    'message' 	=> 'Not found',
                    'data' 		=> 'Empty');
		
        $input = $request->all();
        //from javascript
        if(isset($input) && isset($input['keyword'])){
            //[Nav-Menu]
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        if(isset($input) && $input['operation'] == 'Get all nav menu' && isset($input['lang']) && request('hostname')) {
        	// $input['operation'] = bcrypt($input['operation']);

	        $rests 				= model('Rests')::isexist($input['operation'])->first();
	        
			if(!isset($rests) && empty($rests)) {
			
				$user                   = Rest::create($input);	        
		        $success['token'] 		=  $user->createToken($input['hostname'])->accessToken;
		        $success['operation'] 	=  $user->operation;
			
			}

	        switch($uri)  {
	            case 'nav-menu' : 
                $dm = model('DynMenu')::active()->get(); 
                $dm = response_dyn_menu($dm,'','get',$input['lang']);
                break;
	        }
            $dm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $dm);
    	}else {
            $dm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($dm,Res::HTTP_OK);
    }

    /*
		-Method Get
    */ 

    public function getMenu(Request $request, $uri = "") {

        $dm =  array('status' => 'Error',
                        'code' => Res::HTTP_NOT_FOUND,
                        'message' => 'Not found',
                        'data' => 'Empty');
        return response()->json($dm,Res::HTTP_NOT_FOUND);
    }
}
