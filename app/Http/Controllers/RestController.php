<?php

namespace App\Http\Controllers;

//log
use Illuminate\Support\Facades\Log;

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

class RestController extends Res
{
    //

    public function postApi(Request $request,$uri1 = '',$uri2 = '') {
        
        $content = $request->getContent();
        $req = json_decode($content,true);

        $response = array('status' => 'ada',
                        'code' => Res::HTTP_NOT_FOUND,
                        'message' => 'Not found',
                        'data' => 'Empty');
        $headers = getRequestHeaders();
        
        if(isset($headers["Origin"])) {
            $hostname  = remove_http($headers["Origin"]);
        }else {
            $hostname  = '';
        }
        //hostname 'bayusyaits.com'.
        
        if(isset($headers['Secret'])) {
            $req['secret_key'] = cryptoJsAesDecrypt($hostname, $headers['Secret']);
        }else {
            $req['secret_key'] = 0;
        }
        
        $string   = str_replace('api/v1/', '', $request->path());

        if(isset($req) && isset($req["form_params"]) && isset($req["body"]) && isset($headers) && isset($headers["Authorization"]) && !empty($headers["Authorization"]) && isset($headers["Host"]) && isset($headers["Origin"])) {

            $req['hostname']        = $hostname;
            $req['form_params']     = $req['form_params'];
            $req['ip']              = $request->ip();
            $query                  = getClientQueryApi($req);
            $url                    = getUrlApi().$string;
            $client                 = new Client(getClientHeadersApi($req));
            $request                = $client->post($url, ['query' => $query]);

            if($request->getStatusCode() == 200) {
                try {
                    $response = json_decode($request->getBody()->getContents(),true);
                }
                catch (GuzzleHttp\Exception\ClientException $e) {
                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                }
            }else {
                $response = array(
                        'status'    => 'Error',
                        'code'      => Res::HTTP_FORBIDDEN,
                        'message'   => 'Forbidden',
                        'data'      => 'Empty'); 
            }

        }else if(isset($req) && isset($req['body']) && isset($headers) && isset($headers["Authorization"]) && !empty($headers["Authorization"])) {
//          $req['hostname']        = $request->root();
            $req['hostname']        = $hostname;
            $req['ip']              = $request->ip();
            $url                    = getUrlApi().$string;
            $client                 = new Client(getClientHeadersApi($req));
            $request                = $client->post($url, ['query' => $req]);

            if($request->getStatusCode() == 200) {
                try {
                    $response = json_decode($request->getBody()->getContents(),true);
                }
                catch (GuzzleHttp\Exception\ClientException $e) {
                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                }
            }else {
                $response = array(
                        'status'    => 'Error',
                        'code'      => Res::HTTP_FORBIDDEN,
                        'message'   => 'Forbidden',
                        'data'      => 'Empty'); 
            }

        }else {
            $response = array(
                        'status'    => 'Error',
                        'code'      => Res::HTTP_FORBIDDEN,
                        'message'   => 'Forbidden',
                        'data'      => 'Empty');   
        }
        //log info
        Log::info('RestContoller', [
            'request' => $req,
            'response' => $response
        ]);
        return $response;
    }
}
