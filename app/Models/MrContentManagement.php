<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MrContentManagement extends Model
{
    // Import Notifiable Trait
    use Notifiable;
    
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_content_management';
    protected $primaryKey = 'mcm_id';
    protected $dates = ['mcm_deleted_at'];
    protected $foreignKey = [
        'mcm_dm_id',
        'mcm_tg_id',
        'mcm_mc_id',
        'mcm_mm_id',
        'mcm_mtp_id',
        'mcm_mt_id',
    ];
    protected $fillable = [
        'mcm_is_parent',
        'mcm_parent_id',
        'mcm_salt',
        'mcm_show',
        'mcm_deleted_at',
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'mcm_create_at';
    const UPDATED_AT = 'mcm_update_at';
    
    public function __construct(){
        parent::__construct();
    }
    protected $fieldRules = [
        "mcm_id"=>["",""],
        "mcm_mt_id"=>["",""],
        "mcm_dm_id"=>["",""],
        "mcm_tg_id"=>["",""],
        "mcm_mc_id"=>["",""],
        "mcm_mm_id"=>["",""],
        "mcm_is_parent"=>["",""],
        "mcm_parent_id"=>["",""],
        "mcm_salt"=>["",""],
        "mcm_show"=>["required",""],
    ];

    // Specify Slack Webhook URL to route notifications to 
    public function routeNotificationForSlack() {
        return config('app.log_slack_webhook_url');
    }

    /*
     Funtion
     */
     
    public function scopeContentActive($query)
        {
            return $query->where(['mcm_show'=> 555,'mcm_deleted_at'=>0]);
        }
    public function scopeContentMenu($query) {
        return $query->selectRaw('mcm_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_id,dm_url,dm_uri,dm_initial,dm_keyword,dm_mcl_initial,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mm_create_at,mm_update_at,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->join('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->orderBy('mcm_id','asc')
                     ->where([
                    'mtp_keyword'       => '[Content-Menu]',
                    'mtp_uri'           => 0,
                    'mtp_is_parent'     => 1,
                    'mcm_is_parent'     => 1,
                    'mtp_parent_id'     => 0,
                    'mcm_parent_id'     => 0,
                    'mcm_deleted_at'    => 0,
                    'dm_deleted_at'     => 0,
                    'mcl_dm_table.mcl_deleted_at'     => 0,
                    'mcm_show'          => 555,
                    'mtp_show'          => 555,
                    'mtp_deleted_at'     => 0
                    ])
                    ->offset(0)
                    ->limit(5)
                    ;
    }
    public function scopeContentMenuPage($query,$id) {
        return $query->selectRaw('mcm_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_id,dm_url,dm_uri,dm_initial,dm_keyword,dm_mcl_initial,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mm_create_at,mm_update_at,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->leftjoin('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->orderBy('mcm_id','asc')
                     ->where([
                    'dm_id'             => $id,
                    'mtp_uri'           => 0,
                    'mtp_is_parent'     => 1,
                    'mcm_is_parent'     => 1,
                    'mtp_parent_id'     => 0,
                    'mcm_parent_id'     => 0,
                    'mcm_deleted_at'    => 0,
                    'dm_deleted_at'     => 0,
                    'mcl_dm_table.mcl_deleted_at'     => 0,
                    'mcm_show'          => 555,
                    'mtp_show'          => 555,
                    'mtp_deleted_at'     => 0
                    ])
                    ;
    }

    public function scopeSingleContentProjectStats($query,$keyword,$url) {
        return $query->selectRaw('mcm_id,mcm_mt_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_mcl_initial,dm_name,dm_initial,dm_keyword,dm_uri,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mtp_create_at,mtp_update_at,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mc_id,mm_create_at,mm_update_at,mc_mcl_initial,mc_initial,mc_parent_id,mt_id,mt_initial,mt_keyword,mt_show,mt_deleted_at,ms_id,ms_product,ms_keyword,ms_formula,ms_results,ms_initial,ms_punch_en,ms_punch_id,ms_body_en,ms_body_id,ms_start_date,ms_finish_date,mcl_mc_table.mcl_content_id as mc_content_id,mcl_mc_table.mcl_content_en as mc_content_en,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en,
            ms_mcl_initial_role,mcl_ms_table.mcl_content_id as ms_role_id,mcl_ms_table.mcl_content_en as ms_role_en')
                     ->leftjoin('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_categories','mcm_mc_id','=','mc_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_templates','mt_id','=','mcm_mt_id')
                     ->leftjoin('mr_stats','ms_mcm_id','=','mcm_id')
                     ->leftjoin('mr_content_language as mcl_mc_table','mcl_mc_table.mcl_initial','=','mr_categories.mc_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_ms_table','mcl_ms_table.mcl_initial','=','mr_stats.ms_mcl_initial_role')
                     ->where([
                        'mtp_url'           => $url,
                        'mtp_keyword'       => $keyword,
                        'mtp_is_parent'     => 1,
                        'mcm_is_parent'     => 1,
                        'mc_deleted_at'      => 0,
                        'mcm_show'          => 555,
                        'mcm_deleted_at'    => 0,
                        'mm_is_parent'      => 1,
                        'mm_show'          => 555,
                        'mm_deleted_at'     => 0,
                        'mtp_show'          => 555,
                        'mt_show'           => 555,
                        'mt_deleted_at'     => 0,
                        'ms_show'           => 555,
                        'ms_deleted_at'     => 0,
                        'mcl_mc_table.mcl_deleted_at'     => 0,
                        'mcl_dm_table.mcl_deleted_at'     => 0,
                        'mcl_mm_table.mcl_deleted_at'     => 0,
                        'mcl_ms_table.mcl_deleted_at'     => 0,
                        ])
                    ;
    }

    public function scopeSinglePageContentStats($query,$keyword,$url) {
        return $query->selectRaw('mcm_id,mcm_mt_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_initial,dm_name,dm_initial,dm_keyword,dm_uri,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mtp_create_at,mtp_update_at,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mc_id,mm_create_at,mm_update_at,mc_mcl_initial,mc_initial,mc_parent_id,mt_id,mt_initial,mt_keyword,mt_show,mt_deleted_at,ms_id,ms_product,ms_keyword,ms_formula,ms_results,ms_initial,ms_punch_en,ms_punch_id,ms_body_en,ms_body_id,ms_start_date,ms_finish_date,mcl_mc_table.mcl_content_id as mc_content_id,mcl_mc_table.mcl_content_en as mc_content_en,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en,
            ms_mcl_initial_role,mcl_ms_table.mcl_content_id as ms_role_id,mcl_ms_table.mcl_content_en as ms_role_en')
                     ->leftjoin('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_categories','mcm_mc_id','=','mc_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_templates','mt_id','=','mcm_mt_id')
                     ->leftjoin('mr_stats','ms_mcm_id','=','mcm_id')
                     ->leftjoin('mr_content_language as mcl_mc_table','mcl_mc_table.mcl_initial','=','mr_categories.mc_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_ms_table','mcl_ms_table.mcl_initial','=','mr_stats.ms_mcl_initial_role')
                     ->where([
                        'mtp_url'           => $url,
                        'mtp_keyword'       => $keyword,
                        'mtp_is_parent'     => 1,
                        'mcm_is_parent'     => 1,
                        'mcm_show'          => 555,
                        'mcm_deleted_at'    => 0,
                        'mm_is_parent'      => 1,
                        'mm_show'           => 555,
                        'mm_deleted_at'     => 0,
                        'mtp_show'          => 555,
                        'mcl_dm_table.mcl_deleted_at'     => 0,
                        'mcl_mm_table.mcl_deleted_at'     => 0,
                        'mcl_ms_table.mcl_deleted_at'     => 0,
                        // 'mt_show'           => 555,
                        // 'mt_deleted_at'     => 0,
                        // 'ms_show'           => 555,
                        // 'ms_deleted_at'     => 0,
                        ])
                    ;
    }

    public function scopeSingleContentProject($query,$keyword,$url) {
        return $query->selectRaw('mcm_id,mcm_mt_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_initial,dm_name,dm_initial,dm_keyword,dm_uri,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mtp_create_at,mtp_update_at,mm_id,mm_mcl_initial,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mc_id,mm_create_at,mm_update_at,mc_mcl_initial,mc_initial,mc_parent_id,mt_id,mt_initial,mt_keyword,mt_show,mt_deleted_at,mcl_mc_table.mcl_content_id as mc_content_id,mcl_mc_table.mcl_content_en as mc_content_en,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->leftjoin('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_categories','mcm_mc_id','=','mc_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_templates','mt_id','=','mcm_mt_id')
                     ->leftjoin('mr_content_language as mcl_mc_table','mcl_mc_table.mcl_initial','=','mr_categories.mc_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->where([
                        'mtp_url'           => $url,
                        'mtp_keyword'       => $keyword,
                        'mtp_is_parent'     => 1,
                        'mcm_is_parent'     => 1,
                        'mc_deleted_at'     => 0,
                        'mcm_show'          => 555,
                        'mcm_deleted_at'    => 0,
                        'mm_is_parent'      => 1,
                        'mm_show'           => 555,
                        'mm_deleted_at'     => 0,
                        'mtp_show'          => 555,
                        'mt_show'           => 555,
                        'mt_deleted_at'     => 0,
                        'mcl_mc_table.mcl_deleted_at'     => 0,
                        'mcl_dm_table.mcl_deleted_at'     => 0,
                        'mcl_mm_table.mcl_deleted_at'     => 0,
                        ])
                    ;
    }
    public function scopeContentMenuProject($query,$parent_id = "",$keyword = "", $id = "") {
        return $query->selectRaw('mcm_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_name,dm_initial,dm_keyword,dm_uri,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mtp_create_at,mtp_update_at,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mc_id,mm_create_at,mm_update_at,mc_mcl_initial,mc_initial,mc_parent_id,mcl_mc_table.mcl_content_id as mc_content_id,mcl_mc_table.mcl_content_en as mc_content_en,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->leftjoin('dyn_menu','mcm_dm_id','=','dm_id')
                     ->leftjoin('mr_categories','mcm_mc_id','=','mc_id')
                     ->leftjoin('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->leftjoin('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_content_language as mcl_mc_table','mcl_mc_table.mcl_initial','=','mr_categories.mc_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->orderBy('mcm_id','desc')
                     ->where([
                    'mtp_keyword'       => '[Content-Menu|Portfolio]',
                    'dm_deleted_at'     => 0,
                    'mtp_uri'           => 2,
                    'mtp_is_parent'     => 1,
                    'mcm_is_parent'     => 1,
                    'mc_deleted_at'      => 0,
                    'mtp_parent_id'     => 5525003,
                    'mcm_show'          => 555,
                    'mcm_deleted_at'    => 0,
                    'mtp_show'          => 555,
                    'mtp_deleted_at'     => 0,
                    'mcl_mc_table.mcl_deleted_at'     => 0,
                    'mcl_dm_table.mcl_deleted_at'     => 0,
                    'mcl_mm_table.mcl_deleted_at'     => 0,
                    ]);
    }

    public function scopeRelatedContentProjects($query, $categories = "",$keywords = "", $id = 0, $offset = 0, $limit = 2) {
            $explode = explode(',',$keywords);
            if(isset($explode[1])) {
                foreach ($explode as $key => $value) {
                    # code...
                        $tags[$key] = $value.'%';
                }
            }else {
                $tags = '%'.$keywords.'%';
            } 
        return $query->selectRaw('mcm_id,mcm_dm_id,mcm_mc_id,mcm_mm_id,mcm_mtp_id,mcm_parent_id,mcm_create_at,dm_name,dm_initial,dm_keyword,dm_uri,mtp_id,mtp_initial,mtp_keyword,mtp_title_id,mtp_title_en,mtp_caption_id,mtp_caption_en,mtp_content_id,mtp_content_en,mtp_headline_id,mtp_headline_en,mtp_tags,mtp_token,mtp_parent_id,mtp_url,mtp_create_at,mtp_update_at,mm_id,mm_initial,mm_name,mm_mcl_initial,mm_parent_id,mm_src,mc_id,mm_create_at,mm_update_at,mc_mcl_initial,mc_initial,mc_parent_id,mcl_mc_table.mcl_content_id as mc_content_id,mcl_mc_table.mcl_content_en as mc_content_en,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->join('dyn_menu','mcm_dm_id','=','dm_id')
                     ->join('mr_categories','mcm_mc_id','=','mc_id')
                     ->join('mr_text_posts','mtp_id','=','mcm_mtp_id')
                     ->join('mr_media','mm_id','=','mcm_mm_id')
                     ->leftjoin('mr_content_language as mcl_mc_table','mcl_mc_table.mcl_initial','=','mr_categories.mc_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->where([
                    'mtp_keyword'       => '[Content-Menu|Portfolio]',
                    'dm_deleted_at'     => 0,
                    'mtp_uri'           => 2,
                    'mtp_is_parent'     => 1,
                    'mcm_is_parent'     => 1,
                    'mc_deleted_at'      => 0,
                    'mcm_show'          => 555,
                    'mcm_deleted_at'    => 0,
                    'mtp_parent_id'     => 5525003,
                    'mtp_show'          => 555,
                    'mtp_deleted_at'     => 0,
                    'mcl_mc_table.mcl_deleted_at'     => 0,
                    'mcl_dm_table.mcl_deleted_at'     => 0,
                    'mcl_mm_table.mcl_deleted_at'     => 0,
                    ])
                     ->where('mr_content_management.mcm_id','!=',$id)
                     ->where('mr_text_posts.mtp_tags', 'LIKE', $tags)
                     ->orderBy('mcm_id','desc')
                     ->offset($offset)
                     ->limit($limit);
    }
}