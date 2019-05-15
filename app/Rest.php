<?php
namespace App;
// make token from passport 
use Laravel\Passport\HasApiTokens;
 
use Illuminate\Notifications\Notifiable;
 
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
 
 
class Rest extends Authenticatable
 
{
 
   use HasApiTokens, Notifiable;
 
 
 
   /**
 
    * The attributes that are mass assignable.
 
    *
 
    * @var array
 
    */
 
   protected $fillable = [
 
       'operation',
 
   ];
 
 
 
   /**
 
    * The attributes that should be hidden for arrays.
 
    *
 
    * @var array
 
    */
 
   protected $hidden = [
 
       'operation',
 
   ];

}
