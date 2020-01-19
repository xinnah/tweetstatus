<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class TwitterUnfollowersId extends Model
{
  protected $table = 'twitter_unfollowers_id';
  protected $fillable = ['fk_twitter_id','twitter_id'];

  public static function getUserWiseUnfollowersId($uId)
  {
  	return DB::table('twitter_unfollowers_id')
  	->where('fk_twitter_id', $uId)
  	->get();
  }
  public static function getUserWiseUnfollowersIdCount($uId)
  {
    return DB::table('twitter_unfollowers_id')
    ->where('fk_twitter_id', $uId)
    ->count();
  }

  public static function createUnfollowUsers($uId, $tId)
  {
  	return DB::table('twitter_unfollowers_id')
  	->insert([
  		'fk_twitter_id' => $uId,
  		'twitter_id'    => $tId
  	]);
  }
}
