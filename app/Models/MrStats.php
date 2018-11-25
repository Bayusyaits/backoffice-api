<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrStats extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_stats';
    protected $primaryKey = 'ms_id';
    protected $foreignKey = ['ms_mcm_id'];
    protected $fillable = [
        'ms_show',
        'ms_keyword',
        'ms_formula',
        'ms_mcl_initial_role',
        'ms_product',
        'ms_results',
        'ms_initial',
        'ms_punch_en',
        'ms_punch_id',
        'ms_body_en',
        'ms_body_id',
        'ms_start_date',
        'ms_finish_date',
    ];
    public $timestamps = false;
    protected $dates = ['ms_deleted_at'];
    const CREATED_AT = 'ms_create_at';
    const UPDATED_AT = 'ms_update_at';

    protected $fieldRules = [
        "ms_id"                 =>["",""],
        "ms_keyword"            =>["",""],
        "ms_formula"            =>["required",""],
        "ms_results"            =>["required",""],
        "ms_product"            =>["required",""],
        "ms_initial"            =>["required",""],
        "ms_mcl_initial_role"   =>["required",""],
        "ms_punch_en"           =>["required",""],
        "ms_punch_id"           =>["required",""],
        "ms_body_en"            =>["required",""],
        "ms_body_id"            =>["required",""],
        "ms_show"               =>["required",""],
        "ms_start_date"         =>["required",""],
        "ms_finish_date"        =>["required",""],
    ];

    /*
     Funtion
     */
     
      public function scopePostsActive($query)
      {
          return $query->where(['ms_show'=> 555,'ms_deleted_at'=>0]);
      }
}
