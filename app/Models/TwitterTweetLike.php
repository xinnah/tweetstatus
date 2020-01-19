<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterTweetLike extends Model
{
  protected $table = 'twitter_tweet_like';
  protected $fillable = ['tweet_id','twitter_id'];
}
