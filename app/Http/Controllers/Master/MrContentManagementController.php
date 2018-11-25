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

//passport
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors as HandlesOAuthErrors;

class MrContentManagementController extends Res
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

    public function postContentManagement(Request $request,$uri = '') {
        
        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $mc =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();

        //from javascript
        if(isset($input) && isset($input['keyword'])){
            //[Content-Menu]
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        
        if(isset($input) && $input['operation'] == 'Get all content menu' && isset($input['lang']) && request('hostname')) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
            
            }

            switch($uri)  {
                case 'index' : 
                    $mcm = model('MrContentManagement')::contentmenu()->get(); 
                    if(isset($mcm) && $mcm){
                        $mc = model('MrCategories')::categoriesactive()->get();
                    }
                    
                    if(isset($mc) && $mc) {
                        $mc = response_mr_categories($mc,'join|dm_menu','get',$input['lang']);
                    }
                    
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','get',[],[],$input['lang']);
                    
                    $mcm = array_merge(['content' => $mcm, 'category' => $mc]);
                break;
                case 'home'         : 
                    $mcm = model('MrContentManagement')::contentmenupage(55101)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                case 'about'        : 
                    $mcm = model('MrContentManagement')::contentmenupage(55102)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                case 'portfolio' : 
                    $mcm = model('MrContentManagement')::contentmenupage(55103)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                case 'blog'      : 
                    $mcm = model('MrContentManagement')::contentmenupage(55104)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                case 'contact'      : 
                    $mcm = model('MrContentManagement')::contentmenupage(55105)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                case 'case-studies' : 
                    $mcm = model('MrContentManagement')::contentmenupage(55108)->first(); 
                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','first',[],[],$input['lang']);
                break;
                default: 
                    $mcm = model('MrContentManagement')::contentmenu()->get(); 
                    if(isset($mcm) && $mcm){
                        $mc = model('MrCategories')::categoriesactive()->get();
                        $mcm_p  = model('MrContentManagement')::contentmenuproject(5525003,"[Content-Menu|Portfolio]")->get();
                    }else {
                        $mc = [];
                        $mcm_p  = [];
                    }
                    
                    if(isset($mc) && $mc) {
                        $mc = response_mr_categories($mc,'merge|join|dm_menu','get',$input['lang']);
                    }

                    if(isset($mcm_p) && $mcm_p) {
                        $mcm_p = response_mr_content_management($mcm_p,'merge|join|dm_menu|mr_text_posts|mr_media|mr_categories','get',[],[],$input['lang']);
                    }

                    $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','get',[],[],$input['lang']);
                    $mcm = ['content' => $mcm, 'category' => $mc, 'projects' => $mcm_p];
            }

            $mcm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mcm);
        }else {
            $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mcm,Res::HTTP_OK);
    }
    
    public function postSinglePageContent(Request $request, $uri = '') {
        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();

        //from javascript
        if(isset($input) && isset($input['keyword'])){
            //[Nav-Menu]
            $keyword = '['.$input['keyword'].']';
        }else {
            $keyword = '';
        }
        
        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        
        if(isset($input) && $input['operation'] == 'Get Single Page Content' && isset($input['lang']) && request('hostname') && !empty($uri) && !empty($keyword)) {

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
            
            }
            // else {
                // $user                   = Auth::user(); 
                // Creating a token without scopes...
                // $success['token']       = $user->createToken($input['hostname'])->accessToken;
            // }

            $mcm = model('MrContentManagement')::singlepagecontentstats($keyword,'about')->first(); 
            
            if(!isset($mcm) && !$mcm){
                $mcm = model('MrContentManagement')::contentmenupage(55102)->first();
            }

            if(isset($mcm) && $mcm && isset($mcm['mcm_mm_id']) && $mcm['mcm_mm_id'] != ''){
                $mm = model('MrMedia')::MediaParent($mcm['mcm_mm_id'])->get();
            }else {
                $mm = [];
            }

            $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates|mr_stats','first',$mm,[],$input['lang']);


            if(isset($mcm) && isset($mcm["content_id"]) && $mcm["content_id"] != "") {
                
                $mcm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mcm
                );

            }else {
                $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not Found',
                    'data'      => 'Empty'); 
            }

        }else {
            $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mcm,Res::HTTP_OK);
    }
    public function postContentProjects(Request $request,$uri = '') {
        
        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
                    
        $mc =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        //from javascript

        if(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'portfolio'){
            $keyword   = "[Content-Menu|Portfolio]";
            $parent_id = 5525003;
        }elseif(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'case studies'){
            $keyword   = "[Content-Menu|Case-Studies]";
            $parent_id = 5525009;
        }else {
            $decrypted = 0;
            $keyword   = '';
            $parent_id = 0;
        }
        
        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        if(isset($input) && $input['operation'] == 'Get Content Projects' && isset($input['lang']) && request('hostname') && !empty($keyword)) {
            // $input['operation'] = bcrypt($input['operation']);

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
            
            }

            if(isset($input['sort']) && !empty($input['sort'])){
                $mcm = model('MrContentManagement')::contentmenuproject($parent_id,$keyword)->get();
            }else {
                $mcm = model('MrContentManagement')::contentmenuproject($parent_id,$keyword)->get();
            }
            switch($uri)  {
            case 'projects'     : 
                $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media|mr_categories','get',[],[],$input['lang']);
            break;
            case 'projects-fields' :
                if(isset($mcm) && $mcm){
                    $mc = model('MrCategories')::fields()->get();
                }
                
                if(isset($mc) && $mc) {
                    $mc = response_mr_categories($mc,'join|dm_menu','get',$input['lang']);
                }
                
                $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media|mr_categories','get',[],[],$input['lang']);
                $mcm = array_merge(['content' => $mcm, 'category' => $mc]);
            break;
            }
            
            $mcm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mcm
                );
        }else {
            $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mcm,Res::HTTP_OK);
    }

    public function postSingleContentProject(Request $request, $uri = "") {
        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();
        
        //from javascript
        if(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'portfolio'){
            $keyword   = "[Content-Menu|Portfolio]";
            $parent_id = 5525003;
        }else if(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'case studies'){
            $keyword   = "[Content-Menu|Case-Studies]";
            $parent_id = 5525009;
        }else {
            $decrypted = 0;
            $keyword   = '';
            $parent_id = 0;
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        if(isset($input) && $input['operation'] == 'Get Single Content Project' && isset($input['lang']) && request('hostname') && !empty($uri) && !empty($keyword)) {

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
            
            }

            $mcm = model('MrContentManagement')::singlecontentprojectstats($keyword,$uri)->first(); 
            
            if(!isset($mcm) && !$mcm){
                $mcm = model('MrContentManagement')::singlecontentproject($keyword,$uri)->first();
            }

            if(isset($mcm) && $mcm && isset($mcm['mcm_mm_id']) && $mcm['mcm_mm_id'] != ''){
                $mm = model('MrMedia')::MediaParent($mcm['mcm_mm_id'])->get();
            }else {
                $mm = [];
            }

            if(isset($mcm) && $mcm && isset($mcm['mc_id']) && $mcm['mc_id'] != '' && isset($mcm['mcm_id']) && $mcm['mcm_id'] && isset($mcm['mtp_tags']) && $mcm['mtp_tags']) {
                $mcm_related = model('MrContentManagement')::relatedcontentprojects($mcm['mc_id'],$mcm['mtp_tags'],$mcm['mcm_id'])->get();
            }else {
                $mcm_related = [];
            }

            //if empty response related
            if(isset($mcm_related) && !count($mcm_related)) {
                $mcm_related = model('MrContentManagement')::contentmenuproject($parent_id,$keyword)->get();
            }

            $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates|mr_stats','first',$mm,$mcm_related,$input['lang']);


            if(isset($mcm) && isset($mcm["content_id"]) && $mcm["content_id"] != "") {
                
                $mcm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mcm
                );

            }else {
                $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty'); 
            }

        }else {
            $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mcm,Res::HTTP_OK);
    }

    public function postRelatedProject(Request $request, $uri = "") { 

        $mcm =  array('status'   => 'Error',
                    'code'      => Res::HTTP_NOT_FOUND,
                    'message'   => 'Not found',
                    'data'      => 'Empty');
        
        $input = $request->all();

        //from javascript
        if(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'portfolio'){
            $keyword   = "[Content-Menu|Portfolio]";
            $parent_id = 5525003;
        }elseif(isset($input) && isset($input['keyword']) && isset($input['role']) && $input['role'] == 'case studies'){
            $keyword   = "[Content-Menu|Case-Studies]";
            $parent_id = 5525009;
        }else {
            $decrypted = 0;
            $keyword   = '';
            $parent_id = 0;
        }

        if(isset($input['operation'])){
            $input['operation'] = $input['operation'];
        }else {
            $input['operation'] = '';
        }
        
        
        if(isset($input) && $input['operation'] == 'Get Related Projects' && isset($input['lang']) && request('hostname') && !empty($uri) && !empty($keyword)) {

            $rests              = model('Rests')::isexist($input['operation'])->first();
            
            if(!isset($rests) && empty($rests)) {
            
                $user                   = Rest::create($input);         
                $success['token']       =  $user->createToken($input['hostname'])->accessToken;
                $success['operation']   =  $user->operation;
            
            }

            $mcm = model('MrContentManagement')::relatedcontentprojects('Development','lorem')->get();
            $mcm = response_mr_content_management($mcm,'join|dm_menu|mr_text_posts|mr_media','get',[],[],$input['lang']);

            $mcm =  array(
                    'status'    => 'Success',
                    'code'      => Res::HTTP_OK,
                    'message'   => 'Request has been processed successfully on server',
                    'data'      => $mcm
                );
        
        }else {
            $mcm =  array(
                    'status'    => 'Error',
                    'code'      => Res::HTTP_FORBIDDEN,
                    'message'   => 'Forbidden',
                    'data'      => 'Empty');
        }
        return response()->json($mcm,Res::HTTP_OK);
    }

    /*
        -Method Get
    */


    public function getContentManagement(Request $request, $uri1 = "") {
        
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
    public function getToken(Request $request)
    {
        if(Auth::attempt(['email' => request('username'), 'password' =>  request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return $success['token'];
        }else {
            return 'hai';
        }
    }
    public function issueToken(ServerRequestInterface $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $convert =  $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
            if($convert){
                //ServerRequestInterface -> getParsedBody()
                return 'halo';
            }else {
                return 'hai';
            }
        });
    }
}
