<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserFollowingMsg;
class UserFollowingMsg extends Model
{
  protected $table = 'user_following_msg';
  protected $fillable = ['fk_user_id', 'msg', 'status'];

  public static function checkExistsUserMsg($uId)
  {
  	return UserFollowingMsg::where('fk_user_id', $uId)
  		->first();
  }
}
