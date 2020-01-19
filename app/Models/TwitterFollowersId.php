<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TwitterFollowersId extends Model
{
  protected $table = 'twitter_followers_id';
  protected $fillable = ['fk_twitter_id','twitter_id','backlist'];

  public static function checkExistsId($data)
  {
  	return DB::table('twitter_followers_id')
  	->where('fk_twitter_id', $data['fk_twitter_id'])
  	->where('twitter_id', $data['twitter_id'])
  	->first();
  }
  public static function checkExistsTwitterUser($aId, $tId)
  {
    return DB::table('twitter_followers_id')
    ->where('fk_twitter_id', $aId)
    ->where('twitter_id', $tId)
    ->first();
  }

  public static function getUserWiseFollowersId($uId)
  {
  	return DB::table('twitter_followers_id')
  	->selectRaw('twitter_id')
  	->where('fk_twitter_id', $uId)
    ->orderBy('id','desc')
  	->get();
  }

  public static function getBlackListSelectTwitterId($tId)
  {
    return DB::table('twitter_followers_id')
    ->where('fk_twitter_id', $tId)
    ->where('backlist', 1)
    ->select('twitter_id')
    ->get();
  }
  
}
