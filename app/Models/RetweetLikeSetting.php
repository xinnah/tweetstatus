<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RetweetLikeSetting;
class RetweetLikeSetting extends Model
{
  protected $table = 'retweet_like_setting';
  protected $fillable = ['fk_package_id', 'search_keyword','location', 'avoid_account', 'following_ratio', 'following_count', 'follower_count', 'tweet_count', 'unfollow_back', 'following_speed', 'account_age', 'like_daily', 'unlike_hourly', 'retweet_daily', 'dont_unfollow', 'mute_following', 'admin_changeable', 'egg_profile', 'empty_bio', 'engage_follower', 'status'];

  public static function getCheckExistsUserPackageId($pId)
  {
  	return RetweetLikeSetting::where('fk_package_id', $pId)->first();
  }
}
