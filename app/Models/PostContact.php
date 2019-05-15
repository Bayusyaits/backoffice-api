<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostContact extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'post_contact';
    protected $primaryKey = 'pc_id';
    protected $dates = ['pc_deleted_at'];
    protected $foreignKey = 'pc_dm_id';
    protected $fillable = [
       	'pc_mc_id',
        'pc_username',
        'pc_email',
        'pc_phonenumber',
        'pc_message',
        'pc_reply',
        'pc_ip_address',
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'pc_create_at';
    const UPDATED_AT = 'pc_update_at';
    
    public function __construct(){
        parent::__construct();
    }
    protected $fieldRules = [
        "pc_id"=>["",""],
        "pc_dm_id"=>["",""],
        "pc_mc_id"=>["",""],
        "pc_username"=>["required",""],
        "pc_email"=>["required",""],
        "pc_phonenumber"=>["",""],
        "pc_message"=>["required|min:6",""],
        "pc_reply"=>["",""]
    ];

    public function scopeInsertMessage($query,$posts) {
        $now = \Carbon\Carbon::now();
               setlocale(LC_TIME, 'IND');
        $query->insert([
            //fc = field contact
            'pc_mc_id'              => $posts['category_fc'],
            'pc_username'           => $posts['username_fc'],
            'pc_email'              => $posts['email_fc'],
            'pc_message'            => $posts['message_fc'],
            'pc_ip_address'         => $posts['ip'],
            'pc_create_at'          => $now
        ]);
    }
}
