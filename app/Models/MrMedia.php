<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrMedia extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_media';
    protected $primaryKey = 'mm_id';
    protected $dates = ['mm_deleted_at'];
    protected $foreignKey = 'mm_dm_id';
    protected $fillable = [
        'mm_keyword',
        'mm_initial',
        'mm_name',
        'mm_mcl_initial',
        'mm_url',
        'mm_is_parent',
        'mm_parent_id',
        'mm_show',
        'mm_is_delete'
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'mm_create_at';
    const UPDATED_AT = 'mm_update_at';
    
    public function __construct(){
        parent::__construct();
    }
    protected $fieldRules = [
        "mm_id"             =>["",""],
        "mm_dm_id"          =>["",""],
        "mm_keyword"        =>["required",""],
        "mm_initial"        =>["required",""],
        "mm_name"           =>["required",""],
        "mm_mcl_initial"    =>["required",""],
        "mm_src"            =>["required",""],
        "mm_is_parent"      =>["",""],
        "mm_parent_id"      =>["",""],
        "mm_show"           =>["required",""],
    ];

    /*
     Funtion
     */
     
      public function scopeMediaActive($query)
        {
            return $query->selectRaw('mm_id,mm_dm_id,mm_name,mm_mcl_initial,mm_src,mm_initial,mm_url,mm_keyword,mm_create_at,mm_update_at,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                        ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                       ->where(['mm_show'=> 555,'mm_deleted_at'=>0,'mcl_mm_table.mcl_deleted_at'     => 0,]);
        }
     public function scopeMediaWork($query) {
        return $query->selectRaw('mm_id,mm_dm_id,mm_name,mm_src,mm_initial,mm_mcl_initial,mm_url,mm_keyword,mm_create_at,mm_update_at,dm_name,dm_initial,dm_keyword,dm_uri,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->join('dyn_menu','mm_dm_id','=','dm_id')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->where([
                        'mm_dm_id'                      => 55103,
                        'mm_show'                       => 555,
                        'mm_deleted_at'                 => 0,
                        'mcl_mm_table.mcl_deleted_at'   => 0,
                    ]);
    }
    public function scopeMediaLogosMedsos($query) {
        return $query->selectRaw('mm_id,mm_dm_id,mm_name,mm_src,mm_initial,mm_mcl_initial,mm_url,mm_keyword,mm_create_at,mm_update_at,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                    ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->where([
                        'mm_keyword'                    => '[Media-Logo|Medsos]',
                        'mm_show'                       => 555,
                        'mm_deleted_at'                 => 0,
                        'mcl_mm_table.mcl_deleted_at'   => 0,
                    ]);
    }

    public function scopeMediaLogo($query) {
        return $query->selectRaw('mm_id,mm_dm_id,mm_name,mm_src,mm_initial,mm_mcl_initial,mm_url,mm_create_at,mm_update_at,dm_name,dm_initial,dm_keyword,dm_url,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                     ->leftjoin('dyn_menu','mm_dm_id','=','dm_id')
                     ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                     ->where([
                        'mm_keyword'                    => '[Media-Logo]',
                        'mm_show'                       => 555,
                        'mm_deleted_at'                 => 0,
                        'mcl_mm_table.mcl_deleted_at'   => 0,
                    ]);
    }

    public function scopeMediaParent($query, $id) {
        return $query->selectRaw('mm_id,mm_dm_id,mm_name,mm_src,mm_initial,mm_mcl_initial,mm_url,mm_create_at,mm_update_at,mcl_mm_table.mcl_content_id as mm_alt_id,mcl_mm_table.mcl_content_en as mm_alt_en')
                    ->leftjoin('mr_content_language as mcl_mm_table','mcl_mm_table.mcl_initial','=','mr_media.mm_mcl_initial')
                    ->where([
                        'mm_parent_id'                  => $id,
                        'mm_show'                       => 555,
                        'mm_deleted_at'                 => 0,
                        'mcl_mm_table.mcl_deleted_at'   => 0,
                    ]);
    }
}
