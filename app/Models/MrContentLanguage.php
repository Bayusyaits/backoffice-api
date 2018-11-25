<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrContentLanguage extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'mr_content_language';
    protected $primaryKey = 'mcl_id';
    protected $dates = ['mcl_deleted_at'];
    protected $fillable = [
        'mcl_initial',
        'mcl_content_id',
        'mcl_content_en',
        'mcl_salt',
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'mcl_create_at';
    const UPDATED_AT = 'mcl_update_at';
    
    public function __construct(){
        parent::__construct();
    }
    protected $fieldRules = [
        "mcl_id"=>["",""],
        "mcl_initial"=>["required",""],
        "mcl_content_id"=>["required",""],
        "mcl_content_en"=>["",""],
        "mcl_salt"=>["",""],
    ];

	/*
	 Funtion
	 */
	 
	  public function scopeContentActive($query)
	    {
	        return $query->where(['mcl_deleted_at'=>0]);
	    }
}
