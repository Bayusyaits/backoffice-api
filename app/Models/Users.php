<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    //
    protected static $elq = __CLASS__;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $foreignKey = '';
    protected $dates    = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'ip_address',
        'hostname',
        'date_of_birth',
        'phone_number',
        'gender',
        'is_delete',
        'is_update',
        'u_mrm_id',
    ];

    // public $timestamps = false;
    // const CREATED_AT = 'dm_create_at';
    // const UPDATED_AT = 'dm_update_at';
    public function __construct(){
	    parent::__construct();
    }

    public function scopeActiveUser($query, $data) {
    	return $query->selectRaw('users.name, users.email, users.hostname, oauth_clients.secret, oauth_clients.user_id')
    				 ->leftJoin('firewall','firewall.ip_address', '=', 'user.ip_address')
                     ->leftJoin('oauth_clients','users.id', '=', 'user_id')
    				 ->where([	
    				 	'email'		=>	$data['email'],
    				 	'hostname'	=>	$data['hostname'],
                        'ip_address'=>  Firewall::getIp(),
                        'is_delete' =>  0,
                        'deleted_at'=>  0
    				 	]);
    }
    
    public function scopeUserLogin($query, $data) {
    	return $query->selectRaw('name, email, hostname,
    	created_at, gender, phone_number, password')
    				 ->where([	
    				 	'email'	=>	$data['u_username'],
    				 	'hostname'	=>	'backoffice.bayusyaits.com',
                        'is_delete' =>  0,
                        'deleted_at'=>  0
    				 	]);
    }
    
    public function scopeInsertUser($query, $posts) {
    	$now = \Carbon\Carbon::now();
               setlocale(LC_TIME, 'IND');
        $query->insert([
            'name'            => $posts['u_firstname'].' '.$posts['u_lastname'],
            'email'           => $posts['u_username'],
            'password'        => bcrypt($posts['u_password']),
            'u_mrm_id'        => $posts['u_mrm'],
            'ip_address'      => $posts['u_ip'],
            'gender'       	  => $posts['u_gender'],
            'date_of_birth'   => $posts['u_dob'],
            'phone_number'    => $posts['u_phone_number'],
            'hostname'        => 'backoffice.bayusyaits.com',
            'created_at'      => $now
        ]);
    }

}
