<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrTemplates extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_templates';
    protected $primaryKey = 'mt_id';
    protected $foreignKey = [];
    protected $fillable = [
        'mt_show',
        'mt_keyword',
        'mt_initial',
    ];
    public $timestamps = false;
    protected $dates = ['mt_deleted_at'];
    const CREATED_AT = 'mt_create_at';
    const UPDATED_AT = 'mt_update_at';

    protected $fieldRules = [
        "mt_id"            =>["",""],
        "mt_initial"       =>["",""],
        "mt_keyword"       =>["",""],
        "mt_show"          =>["required",""],
    ];

    /*
	 Funtion
	 */
	 
	  public function scopePostsActive($query)
      {
          return $query->where(['mt_show'=> 555,'mt_deleted_at'=>0]);
      }
}
