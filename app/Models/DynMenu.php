<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynMenu extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'dyn_menu';
    protected $primaryKey = 'dm_id';
    protected $foreignKey = 'dm_tg_id';
    protected $dates = ['dm_deleted_at'];
    protected $fillable = [
        'dm_name',
        'dm_url',
        'dm_mcl_initial',
        'dm_initial',
        'dm_is_parent',
        'dm_parent_id',
        'dm_show',
        'dm_keyword'
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'dm_create_at';
    const UPDATED_AT = 'dm_update_at';
    public function __construct(){
	    parent::__construct();
    }

    public function scopeActive($query)
        {
            return $query->selectRaw('dm_id,dm_url,dm_uri,dm_initial,dm_keyword,dm_mcl_initial,mcl_dm_table.mcl_content_id as dm_content_id,mcl_dm_table.mcl_content_en as dm_content_en')
                         ->leftjoin('mr_content_language as mcl_dm_table','mcl_dm_table.mcl_initial','=','dyn_menu.dm_mcl_initial')
                         ->leftJoin('table_groups','dm_tg_id','=','tg_id')
                         ->where([
                             'dm_tg_id' => 5501,
                             'dm_show'  => 555,
                             'dm_deleted_at'=>0,
                             'mcl_dm_table.mcl_deleted_at'     => 0,
                             ]);
        }
}
