<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterTweets extends Model
{
	protected $table = 'twitter_tweets';
  protected $fillable = ['fk_twitter_id','content', 'date', 'time', 'color', 'file'];
}
