<?php

namespace App\Http\Controllers\Post\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use dingo

use Dingo\Api\Routing\Helpers;

use App\Transformers\AppTransformer;
use Response;
use \Illuminate\Http\Response as Res;

use App\Rest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
use Validator;

//passport
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors as HandlesOAuthErrors;

class LoginController extends Res
{
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

    public function postLogin(Request $request, $uri = "") { 

        $pc =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        //from javascript
        if(isset($input) && isset($input['body'])) {
            $body = $input['body'];
        }else {
            $body = [];
        }
        
        if(isset($input) && isset($input['form_params'])) {
            $form = $input['form_params'];
        }else {
            $form = [];
        }
        
        if(isset($body) && isset($body['keyword'])){
            //[Post-Contact|Message]
            $keyword = '['.$body['keyword'].']';
        }else {
            $keyword = '';
        }
        
		$ip = $request->ip();
		
		if(isset($ip) && !empty($ip)) {
			$form['u_ip'] = $ip;
		}else {
			$form['u_ip'] = null;
		}
                
        if(isset($body) && $body['operation'] == 'Get user' && isset($form)) {
            // $input['operation'] = bcrypt($input['operation']);
                    
            $post = model('Users')::userLogin($form)->first();

            if(isset($post) && !empty($post)) {
	            
	            if(Hash::check($form['u_password'], $post->password)) {
	                $pc = array(
	                    'status'  => 'Success',
	                    'code'    => Res::HTTP_OK,
	                    'message' => 'Your was logged in',
	                    'data'    => $post);
                }else {
	             $pc = array(
	                'status'    => 'Error',
	                'code'      => Res::HTTP_FORBIDDEN,
	                'message'   => 'Forbidden',
	                'data'      => 'Empty');     
                }
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

    /*
        -Method Get
    */


    public function getUsersRegistration(Request $request, $uri1 = "") {
        
        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        // $headers = getRequestHeaders();

        // foreach ($headers as $header => $value) {
        //     echo "$header: $value <br />\n";
        // }
            
            
        return response()->json($mcm,Res::HTTP_NOT_FOUND);
    }
    
}
