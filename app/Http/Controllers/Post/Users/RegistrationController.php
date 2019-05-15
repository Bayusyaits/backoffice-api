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
 
use Validator;

//passport
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors as HandlesOAuthErrors;

class RegistrationController extends Res
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

    public function postRegistration(Request $request, $uri = "") { 

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
            
            if (!isset($form['u_firstname']) 
            || empty($form['u_firstname'])) {
	            
	            $errors['firstname'] = 'Firstname invalid';
            }
            
            if (!isset($form['u_lastname']) 
            || empty($form['u_lastname'])) {
	            $errors['lastname'] = 'Lastname invalid';
            }
            
            if (!isset($form['u_username']) 
            || empty($form['u_username'])) {
	            $errors['username'] = 'Username invalid';
            }
            
            if (!isset($form['u_phone_number']) 
            || empty($form['u_phone_number'])) {
	            $errors['username'] = 'Phone number invalid';
            }
            
            if (!isset($form['u_gender']) 
            || empty($form['u_gender'])) {
	            $errors['gender'] = 'Gender invalid';
            }
            
            if (!isset($form['u_dob']) 
            || empty($form['u_dob'])) {
	            $errors['dob'] = 'Date of birth invalid';
            }
            
            if (!isset($form['u_password']) 
            || empty($form['u_password'])) {
	            $errors['password'] = 'Date of birth invalid';	            
            }
            
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

        if(isset($body) && $body['operation'] == 'Add new user' && isset($form)
        && empty($errors)) {
            // $input['operation'] = bcrypt($input['operation']);
                    
            $post = model('Users')::insertUser($form);

            if(isset($post) && $post) {
                $pc = array(
                    'status'  => 'Success',
                    'code'    => Res::HTTP_OK,
                    'message' => 'Your was registered',
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
                    'data'      => $errors);
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
