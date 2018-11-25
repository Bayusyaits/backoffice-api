<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'oauth_clients';
    protected $primaryKey = 'id';
    protected $foreignKey = [
		'user_id'
    ];
    protected $fillable = [
        'name',
        'secret',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked'
    ];
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fieldRules = [
        "user_id"            		=>["",""],
        "name"         				=>["",""],
        "secret"         			=>["",""],
        "redirect"       			=>["",""],
        "personal_access_client"    =>["",""],
        "password_client"      		=>["",""],
        "revoked"      				=>["",""],
    ];

    /*
	 Funtion
	 */
	 
	  public function scopePostsActive($query)
      {
          return $query->where('revoked', 0);
      }
}
