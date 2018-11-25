<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rests extends Model
{
    //
    protected static $elq   = __CLASS__;
    protected $table        = 'rests';
    protected $primaryKey   = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable     = [
        'operation',
    ];
    public $timestamps = false;
    public function __construct(){
	    parent::__construct();
    }
    //get operation from rests
    public function scopeIsExist($query, $operation)
    {
        return $query->selectRaw('operation')
                     ->where(['operation' => $operation,'deleted_at'=>0])
                     ->orderBy('id', 'desc');
    }
    //carbon custome datetime
    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

}
