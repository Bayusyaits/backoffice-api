<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
 
use Illuminate\Support\Facades\Auth;
 
use Validator;
 
class PassportController extends Controller
 
{
 
 
 
   public $successStatus = 200;
 
 
 
   /**
 
    * login api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function login(){
 
       if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
 
           $user = Auth::user();
 
           $success['token'] =  $user->createToken('bayusyaits.com')->accessToken;
 
           return response()->json(['success' => $success], $this->successStatus);
 
       }
 
       else{
 
           return response()->json(['error'=>'Unauthorised'], 401);
 
       }
 
   }
 
 
 
   /**
 
    * Register api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function register(Request $request)
 
   {
        $input = $request->all();
        
        if(isset($input["hostname"])) {
            $hostname  = remove_http($headers["hostname"]);
        }else {
            $hostname  = '127.0.0.1:3000';
        }
 
       $validator = Validator::make($request->all(), [
 
           'name'     => 'required',
 
           'email'    => 'required|email',
 
           'password'   => 'required',
 
           'c_password' => 'required|same:password',
 
       ]); 
 
       if ($validator->fails()) {
 
           return response()->json(['error'=>$validator->errors()], 401);            
 
       }
        
 
       $input['password'] = bcrypt($input['password']);
 
       $user = User::create($input);
 
       $success['token']  =  $user->createToken($hostname)->accessToken;
 
       $success['name']   =  $user->name;
 
 
 
       return response()->json(['success'=>$success], $this->successStatus);
 
   }
 
 
 
   /**
 
    * details api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function getDetails()
 
   {
 
       $user = Auth::user();
 
       return response()->json(['success' => $user], $this->successStatus);
 
   }
 
}
