<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\TwitterUser;
class TwitterUser extends Model
{
  protected $table = 'twitter_user';
  protected $fillable = ['twitter_id', 'token', 'secret','name', 'screen_name','profile_image','followers_c','following_c','tweets','likes','lists','moments','logged'];

  public static function checkExistsUserId($id)
  {
    return TwitterUser::where('twitter_id', $id)
    ->first();
  }
  public static function checkExistsUser($data)
  {
  	return DB::table('twitter_user')
  	->where('token', $data['oauth_token'])
  	->where('secret', $data['oauth_token_secret'])
  	->where('twitter_id', $data['user_id'])
  	->first();
  }

  public static function insertUser($token, $data)
  {
  	return DB::table('twitter_user')
  	->insertGetId([
  		'twitter_id'    => $token['user_id'],
  		'token'         => $token['oauth_token'],
  		'secret'        => $token['oauth_token_secret'],
  		'name'          => $data['name'],
  		'screen_name'   => $data['screen_name'],
  		'profile_image' => $data['profile_image_url'],
  		'followers_c'   => $data['followers_count'],
  		'following_c'   => $data['friends_count'],
  		'tweets'        => $data['statuses_count'],
  		'likes'         => $data['favourites_count'],
  		'lists'         => $data['listed_count'],
      'moments'       => 0,
  		'created_at' => date('Y-m-d h:i:s') 
  	]);
  }
  public static function updateUserTokenInfo($id, $token)
  {
    return DB::table('twitter_user')
    ->where('twitter_id',$id)
    ->update([
      'token'  => $token['oauth_token'],
      'secret' => $token['oauth_token_secret']
    ]);
  }
  public static function updateUserLogged($id)
  {
    return DB::table('twitter_user')
    ->where('twitter_id',$id)
    ->update([
      'logged' => 1
    ]);
  }
  public function user_settings_package(){
    return $this->hasMany('App\Models\UserSettingsPackage','account_id','twitter_id');
  }
}
