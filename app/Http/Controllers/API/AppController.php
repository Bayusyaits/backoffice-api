<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MrCategories;
use App\Models\MrContentLanguage;
use App\Models\MrContentManagement;
use App\Models\MrMedia;
use App\Models\DynMenu;

//use dingo

use Dingo\Api\Routing\Helpers;

//guzzle client api
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Transformers\AppTransformer;
use Response;
use \Illuminate\Http\Response as Res;

class AppController extends Res
{

    public function __construct() {
       
    }

    use Helpers;
    //
    public function getIndex(AppTransformer $transformer) {
       return $transformer->transform(5501);
    }
    public function postPage(Request $requests) {
        
        $content = $requests->getContent();
        $req = json_decode($content,true);

        return $req['operation'];
        // return response()->json(['name' => 'Abigail', 'state' => 'CA'])
        //     ->withCallback($requests->input('callback'))->header('Content-Type', 'text/plain')->header('X-Header-One', 'Header Value')
        //     ->header('X-Header-Two', 'Header Value');


        // return $requests->url();
    }
    public function postPag(Request $requests,$uri = '') {
        
        $content = $requests->getContent();
        $req = json_decode($content,true);

        if($req['operation'] == "Get menu pages") {
            $url    = getUrlApi().'pages/'.$req['mcm_id'];
            $client = new Client();
            $request = $client->get($url.'pages/home', ['auth' =>  ['user', 'pass']]);
            $response = $request->getBody();
        }
        return $response;
    }    
    
    public function respondInternalError($message){
        return $this->respond([
            'status' => 'Error',
            'code' => Res::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
        ]);
    }
    public function respondValidationError($message, $errors){
        return $this->respond([
            'status' => 'Error',
            'code' => Res::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $errors
        ]);
    }
    public function respond($data, $headers = []){
        return Response::json($data, $this->getStatusCode(), $headers);
    }
    public function respondWithError($message){
        return $this->respond([
            'status' => 'Error',
            'code' => Res::HTTP_UNAUTHORIZED,
            'message' => $message,
        ]);
    }
}
