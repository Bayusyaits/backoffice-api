<?php

namespace App\Http\Controllers\Post;

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

//passport
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors as HandlesOAuthErrors;

class PostContactController extends Res
{
    //
    //

    use Helpers,HandlesOAuthErrors;

    /**
     * The authorization server.
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @param  \League\OAuth2\Server\AuthorizationServer  $server
     * @param  \Laravel\Passport\TokenRepository  $tokens
     * @param  \Lcobucci\JWT\Parser  $jwt
     * @return void
     */
    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    /*
		-Method Post
    */
    public function postMessages(Request $request,$uri = '')
    {
        
        $pc =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        //from javascript
        if(isset($input) && isset($input['keyword'])){
            //[Post-Contact|Message]
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }

        if(isset($input) && isset($input['body'])) {
            $body = $input['body'];
        }else {
            $body = [];
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        if(isset($input) && isset($body) && $input['operation'] == 'Add new message' && request('hostname')) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
                $success['name']        =  $user->name;
            
            }

            
           
            switch($uri)  {
                case 'contact'     : 
                    $post = model('PostContact')::insertmessage($body);
                  break;
            }

            if($post) {
                $pc = array(
                    'status'  => 'Success',
                    'code'    => Res::HTTP_OK,
                    'message' => 'Your message was successfully delivered',
                    'data'    => 'Delivered');
                }else {
                 $pc = array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');   
                }

        }else {
            $pc =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($pc,Res::HTTP_OK);
    }

	public function postForm(ServerRequestInterface $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $convert =  $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
            $body = $request->getParsedBody();
            if(isset($body) && !empty($body) && isset($body['body'])){
                $body = $body['body'];
                $body['operation'] = $body['operation'];
            }else{
                $body = [];
                $body['operation'] = '';
            }
            $response = array(
						'status'  => 'Success',
						'code'    => Res::HTTP_OK,
						'message' => 'Success',
						'data'    => 'Not Empty');

            if($convert && isset($body) && $body['operation'] == 'Add new message'){
                //ServerRequestInterface -> getParsedBody()
                $rests 				= model('Rests')::isexist($body['operation'])->first();
	        
					if(!isset($rests) && empty($rests)) {
					
						$user                   = Rest::create($body);	        
				        $success['operation'] 	= $user->operation;
					
					}else {
		                $user                   = Auth::user(); 
		            }

                if(isset($body['category_fc']) && !empty($body['category_fc'])) {
		          $pc = model('PostContact')::insertmessage($body);
                  return $response;
                }else {
                    return array(
                            'status'    => 'Error',
                            'code'      => Res::HTTP_FORBIDDEN,
                            'message'   => 'Forbidden',
                            'data'      => 'Empty');
                }    
            }else {
                return array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
            }
        });
    }
}
