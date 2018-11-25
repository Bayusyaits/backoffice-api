<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrCategories extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_categories';
    protected $primaryKey = 'mc_id';
    protected $foreignKey = 'mc_dm_id';
    protected $dates    = ['mc_deleted_at'];
    protected $fillable = [
        'mc_type',
        'mc_mcl_initial',
        'mc_is_parent',
        'mc_parent_id',
        'mc_show',
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'mc_create_at';
    const UPDATED_AT = 'mc_update_at';
    
    public function __construct(){
        parent::__construct();
    }
    protected $fieldRules = [
        "mc_id"=>["",""],
        "mc_dm_id"=>["",""],
        "mc_type"=>["required",""],
        "mc_mcl_initial"=>["required",""],
        "mc_is_parent"=>["",""],
        "mc_parent_id"=>["",""],
        "mc_show"=>["",""],
    ];

    /*
     Funtion
     */
     

public function scopeCategoriesActive($query)
    {
        return $query->selectRaw('
                            mc_id,
                            mc_dm_id,
                            mc_type,
                            mc_mcl_initial,
                            mc_initial,
                            mc_is_parent,
                            mc_parent_id,
                            mcl_mc_table.mcl_content_id as mc_content_id,
                            mcl_mc_table.mcl_content_en as mc_content_en')
                    ->leftjoin('mr_content_language as mcl_mc_table' , 
                            'mcl_mc_table.mcl_initial', '=' , 
                            'mr_categories.mc_mcl_initial')
                    ->where([
                    'mc_show'=> 555,
                    'mc_deleted_at'  => 0,
                    'mcl_deleted_at'     => 0,
                    'mcl_mc_table.mcl_deleted_at'     => 0
                    ]);
    }
public function scopeFields($query) {
    return $query->selectRaw('
                            mc_id,
                            mc_dm_id,
                            mc_type,
                            mc_mcl_initial,
                            mc_initial,
                            mc_is_parent,
                            mc_parent_id,
                            dm_id,
                            dm_name,
                            mcl_mc_table.mcl_content_id as mc_content_id,
                            mcl_mc_table.mcl_content_en as mc_content_en')
                 ->join('dyn_menu','mc_dm_id','=','dm_id')
                 ->leftjoin('mr_content_language as mcl_mc_table' , 
                            'mcl_mc_table.mcl_initial', '=' , 
                            'mr_categories.mc_mcl_initial')
                 ->where([
                'mc_type'            => 'Field',
                'mc_dm_id'           => 55103,
                'mc_show'            => 555,
                'mc_deleted_at'      => 0,
                'mcl_deleted_at'     => 0,
                'mcl_mc_table.mcl_deleted_at'     => 0,
                ]);
}
public function scopeCategories($query) {
    return $query->selectRaw('
                            mc_id,
                            mc_dm_id,
                            mc_type,
                            mc_mcl_initial,
                            mc_initial,
                            mc_is_parent,
                            mc_parent_id,
                            dm_id,
                            dm_name,
                            mcl_mc_table.mcl_content_id as mc_content_id,
                            mcl_mc_table.mcl_content_en as mc_content_en')
                 ->join('dyn_menu','mc_dm_id','=','dm_id')
                 ->leftjoin('mr_content_language as mcl_mc_table' , 
                            'mcl_mc_table.mcl_initial', '=' , 
                            'mr_categories.mc_mcl_initial')
                 ->where([
                'mc_show'        => 555,
                'mc_deleted_at'   => 0,
                'mcl_deleted_at'     => 0,
                'mcl_mc_table.mcl_deleted_at'     => 0
                ]);
}
public function scopeSubjects($query) {
    return $query->selectRaw('
                            mc_id,
                            mc_dm_id,
                            mc_type,
                            mc_mcl_initial,
                            mc_initial,
                            mc_is_parent,
                            mc_parent_id,
                            dm_id,
                            dm_name,
                            mcl_mc_table.mcl_content_id as mc_content_id,
                            mcl_mc_table.mcl_content_en as mc_content_en')
                 ->join('dyn_menu','mc_dm_id','=','dm_id')
                 ->leftjoin('mr_content_language as mcl_mc_table' , 
                            'mcl_mc_table.mcl_initial', '=' , 
                            'mr_categories.mc_mcl_initial')
                 ->where([
                'mc_type'       => 'Subject',
                'mc_dm_id'      => 55105,
                'mc_show'       => 555,
                'mc_deleted_at'  => 0,
                'mcl_deleted_at'     => 0,
                'mcl_mc_table.mcl_deleted_at'     => 0
                ]);
}

}
