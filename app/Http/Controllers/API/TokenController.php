<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use App\Models\RegistrationData;
use Illuminate\Support\Facades\Crypt;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;

class TokenController extends Controller
{
	public function __construct() {
		$this->user = new RegistrationData;
	}
    public function auth(Request $request)
    {
    	Config::set('auth.providers.users.model', \App\Models\RegistrationData::class);
        // grab credentials from the request
        $credentials = $request->only('rd_email', 'rd_password');
        
        $validator = Validator::make($credentials,array(
	    'rd_email'=>'required|email|max:255',
	    'rd_password'=>'required|min:6'
	    ));
		
		if($validator->fails()) {
			return response()->json(
			['code'=>1,
			 'message'=>'Validation failed',
			 'errors'=>$validator->errors()	
			],422);
		}
		$token = JWTAuth::attempt($credentials);
		if($token) {
			return response()->json(['token'=>$token]);
		}else{
			return response()->json(
			['code'=>2,
			 'message'=>'Invalid Cresidentials'
			],401);
		}

        // all good so return the token
    }
    
    public function token(Request $request)
    {
        $user = JWTAuth::toUser($request->token);        
        return response()->json(['result' => $user]);

        // all good so return the token
    }
    public function getUser(Request $request)
    {
        JWTAuth::setToken($request->input('token'));
        $user = JWTAuth::toUser();
        return response()->json($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return 'Halo';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return 'Halo';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
