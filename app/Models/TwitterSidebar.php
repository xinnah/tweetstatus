<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TwitterSidebar;
use DB;
class TwitterSidebar extends Model
{
  protected $table = 'twitter_sidebar';
  protected $fillable = ['twitter_id', 'unfollowers', 'followers', 'followers_new', 'following', 'following_new', 'non_followback', 'idont_followback', 'blocked', 'muted', 'whitelist', 'blacklist', 'ac_following', 'ac_unfollowing', 'ac_block', 'ac_mute','ac_date', 'updated_date', 'sync_time', 'session_time'];

  public static function getCheckThisAccountExist($tId)
  {
  	return TwitterSidebar::where('twitter_id', $tId)
  	->first();
  }
}
