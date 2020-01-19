<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterFollowing extends Model
{
  protected $table = 'twitter_following';
  protected $fillable = ['fk_twitter_id','twitter_id','name', 'screen_name','profile_image','followers_c','following_c','tweets','likes','lists','moments','following','follow_by'];
}
