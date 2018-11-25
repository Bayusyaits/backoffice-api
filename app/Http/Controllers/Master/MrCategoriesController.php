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

class MrCategoriesController extends Res
{
    //
    public function __construct() {

    }

    use Helpers;
    //

    public function postCategories(Request $request,$uri = '') {
        
        $mc =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        $url = $request->url();

         //from javascript
        if(isset($input) && isset($input['keyword']) && !empty($uri)) {
            //[Categories-Fields] || [Categories-Subjects]
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
       
       
        if(isset($input) && $input['operation'] == 'Get all categories' && isset($input['lang']) && request('hostname')) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       = $user->createToken($input['hostname'])->accessToken;
                $success['operation']   = $user->operation;
            
            }

            switch($uri)  {
                case 
                    'fields'       : $mc = model('MrCategories')::fields()->get(); 
                break;
                case 
                    'categories'   : $mc = model('MrCategories')::categories()->get();
                break;
                case 'subjects'    : 
                    $mc = model('MrCategories')::subjects()->get();
                break;
                default: 
                    $mc = model('MrCategories')::categories()->get();
            }
            $mc = response_mr_categories($mc,'join|dm_menu','get',$input['lang']);
            $mc = array(
                        'status'    => 'Success',
                        'code'      => Res::HTTP_OK,
                        'message'   => 'Request has been processed successfully on server',
                        'data'      => $mc
                    );
        }else {
            $mc =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mc,Res::HTTP_OK);
    }

    public function getCategories($uri = "") {
        $mc     =   array(
                    'status'        =>  'Error',
                    'code'          =>  Res::HTTP_NOT_FOUND,
                    'message'       =>  'Not found',
                    'data'          => 'Empty');
        return response()->json($mc,Res::HTTP_NOT_FOUND);
    }
}
