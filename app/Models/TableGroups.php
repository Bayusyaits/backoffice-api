<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableGroups extends Model
{
    //
    protected static $elq = __CLASS__;
    protected $table = 'table_groups';
    protected $primaryKey = 'tg_id';
    protected $fillable = [
        'tg_name',
    ];
    
    public $timestamps = false;
    const CREATED_AT = 'tg_create_at';
    const UPDATED_AT = 'tg_update_at';
    
    public function __construct(){
        parent::__construct();
    }
}
