<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontEndController;
use App\Models\MrCategories;
use App\Models\MrContentLanguage;
use App\Models\MrContentManagement;
use App\Models\MrMedia;

class AppController extends FrontendController
{
    //

    public function getIndex() {
    	$mc_fields = MrCategories::fields()->get();
    	return view('layout/master');
    } 
    public function getContact() {
    	$mc_fields = MrCategories::fields()->get();
    	return json($mc_fields);
    } 

    public function postMessage() {
  //   	if($request->ajax()){
	 //    $data = array();
	 //    $errors = array();
		
		// $fullname = _post('fullname');
		// $email = _post('email');
		// $message = _post('message');
		
	 //    if(empty($fullname)){
	 //    $data['fullname'] = 'This field is Required';
	 //    $errors['fullname'] = true;
	 //    }
	 //    if(empty($email)){
	 //    $data['email'] = 'This field is Required.';
	 //    $errors['email'] = true;
	 //    }
	 //    if(empty($message)){
	 //    $data['message'] = 'This field is Required..';
	 //    $errors['message'] = true;
	 //    }
	 //    if($errors){
	 //    $data['success'] = false;
	 //    $data['warning'] = 'try again';
	 //    }else{
		// $data['success'] = true;
	 //    $data['warning'] = 'success';  
	 //    $post = new PostContact;
	 //    $post->pc_fullname = $request->fullname;
		// $post->pc_email = $request->email;
		// $post->pc_message = $request->message;
	 //    $post->save();  
	 //    }
	 //    return response()->json($data);
	 //    //->withCallback($request->input('callback'));
	    
	    
	 //    }
    }
}
