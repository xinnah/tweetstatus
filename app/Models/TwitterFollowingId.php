<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TwitterFollowingId extends Model
{
  protected $table = 'twitter_following_id';
  protected $fillable = ['fk_twitter_id','twitter_id', 'whitelist'];

  public static function checkExistsId($data)
  {
  	return DB::table('twitter_following_id')
  	->where('fk_twitter_id', $data['fk_twitter_id'])
  	->where('twitter_id', $data['twitter_id'])
  	->first();
  }
  public static function checkExistsTwitterUser($aId, $tid)
  {
    return DB::table('twitter_following_id')
    ->where('fk_twitter_id', $aId)
    ->where('twitter_id', $tid)
    ->first();
  }

  public static function getUserWiseFollowingId($uId)
  {
  	return DB::table('twitter_following_id')
  	->selectRaw('twitter_id')
  	->where('fk_twitter_id', $uId)
    ->orderBy('id','desc')
  	->get();
  }

  public static function getWhiteListSelectTwitterId($tId)
  {
    return DB::table('twitter_following_id')
    ->where('fk_twitter_id', $tId)
    ->where('whitelist', 1)
    ->select('twitter_id')
    ->get();
  }

  public static function getDateWiseFollowingData($date)
  {
    return DB::table('twitter_following_id')
    ->whereDate('created_at', $date)
    ->get();
  }
}
