<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\UserPackages;
class UserPackages extends Model
{
  
  protected $table = 'user_package';
  protected $fillable = ['fk_user_id', 'fk_package_id', 'account_id', 'start_date','end_date', 'status'];

  public static function checkExistsPackage($data)
  {
  	return UserPackages::where('fk_user_id', $data['fk_user_id'])
  	->first();
  }

  public function Plans(){
    return $this->belongsTo('App\Models\Plans','fk_package_id');
  }

  public function twitter_user(){
    return $this->belongsTo('App\Models\TwitterUser','account_id', 'twitter_id');
  }

  public function users()
  {
    return $this->belongsTo('App\User', 'fk_user_id');
  }

  public static function getExistsUserPackage($data)
  {
    return UserPackages::where('fk_user_id', $data['user_id'])->where('account_id', $data['twitter_id'])->first();
  }


}
