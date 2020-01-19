<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FollowUnfollowSetting;
class FollowUnfollowSetting extends Model
{
  protected $table = 'follow_unfollow_setting';
  protected $fillable = ['fk_package_id', 'search_keyword','location', 'avoid_account', 'following_ratio', 'following_count', 'follower_count', 'tweet_count', 'unfollow_back', 'following_speed', 'account_age', 'dont_unfollow', 'mute_following', 'admin_changeable', 'egg_profile', 'empty_bio', 'engage_follower', 'status'];

  public static function getCheckExistsUserPackageId($pId)
  {
  	return FollowUnfollowSetting::where('fk_package_id', $pId)->first();
  }
}
