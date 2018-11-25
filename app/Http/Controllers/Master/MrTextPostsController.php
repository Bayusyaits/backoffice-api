<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use dingo
use Dingo\Api\Routing\Helpers;


use App\Transformers\AppTransformer;
use Response;
use \Illuminate\Http\Response as Res;

use App\Rest;

use Illuminate\Support\Facades\Auth;
 
use Validator;

class MrTextPostsController extends Res
{
    //
    public function __construct() {

    }

    use Helpers;
    //

    public function postText(Request $requests,$uri = '') {
        
        $mtp =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $requests->all();
        //from javascript
        if(isset($input) && isset($input['password'])){
            $input['password'] = $input['password'];
        }else {
            $input['password'] = null;
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }

        if($uri         == 'fields'){
            $decrypted  = cryptoJsAesDecrypt("[Categories-Fields]", $input['password']);
        }else if($uri   == 'subjects'){
            $decrypted  = cryptoJsAesDecrypt("[Categories-Subjects]", $input['password']);
        }else {
            $decrypted  = cryptoJsAesDecrypt("[Categories]", $input['password']);
        }
        
        if(isset($input) && $input['operation'] == 'Get all categories' && Auth::attempt(['email' => request('username'), 'password' => $decrypted , 'hostname' => request('hostname')])) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       = $user->createToken($input['hostname'])->accessToken;
                $success['operation']   = $user->operation;
            
            }else {
                $user                   = Auth::user(); 
                // Creating a token without scopes...
                $success['token']       = $user->createToken($input['hostname'])->accessToken;

                // Creating a token with scopes...
                // $token = $user->createToken('My Token', ['place-orders'])->accessToken;
            }

            switch($uri)  {
                case 
                    'fields'       : $mtp = model('MrCategories')::fields()->get(); 
                break;
                default: 
                    $mtp = model('MrCategories')::categories()->get();
            }

        }else {
            $mtp =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mtp,Res::HTTP_OK);
    }

    public function getText($uri = "") {
        $mtp 	=  	array(
        			'status' 		=> 	'Error',
                    'code'			=> 	Res::HTTP_NOT_FOUND,
                    'message' 		=> 	'Not found',
                    'data' 			=> 'Empty');
        return response()->json($mtp,Res::HTTP_OK);
    }
}
