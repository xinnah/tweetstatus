<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Role extends Model
{
  protected $table = 'role';
  protected $fillable = ['role_name', 'status'];

  public static function createRole($input){
  	 
	return DB::table('role')
  	->insertGetId([
  		'role_name' => $input['role_name'],
  		'status' => $input['status'],
  		'created_at' => date('Y-m-d h:i:s')
  		]);
  }

  public static function getRoleWiseRole($roleId){
      
      return DB::table('role')
      ->where('id',$roleId)
      ->first();  
  }

  public static function checkUserRoleId()
  {
    return DB::table('role')
      ->where('role_name','user')
      ->first(); 
  }
  public static function getSuperAdminId()
  {
    return DB::table('role')
      ->where('role_name','super admin')
      ->first(); 
  }
}
