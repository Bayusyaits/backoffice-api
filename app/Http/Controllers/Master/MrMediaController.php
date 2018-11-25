<?php

namespace App\Http\Controllers\Master;


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

class MrMediaController extends Res
{
    //
    public function __construct() {

    }

    use Helpers;


    public function postMedia(Request $request,$uri = '') {
        
        $mm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        //from javascript
        if(isset($input) && isset($input['keyword'])){
            //Media
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        if(isset($input) && $input['operation'] == 'Get all media' && request('hostname')) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       = $user->createToken($input['hostname'])->accessToken;
                $success['operation']   = $user->operation;
            
            }

            switch($uri)  {
                case 
                    'med-sos' : $mm = model('MrMedia')::medialogosmedsos()->get(); 
                break;
                default: 
                    $mm = model('MrMedia')::medialogosmedsos()->get();
            }
            $mm = response_mr_media($mm,'join|dyn_menu','get');
            $mm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mm);

        }else {
            $mm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mm,Res::HTTP_OK);
    }

    public function getMedSos(Request $request, $uri = "") {
        $mm =  model('MrMedia')::medialogosmedsos()->get();
        $mm = response_mr_media($mm,'join|dyn_menu','get');
        return response()->json($mm,Res::HTTP_OK);
    }
}
