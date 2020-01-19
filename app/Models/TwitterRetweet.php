<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterRetweet extends Model
{
  protected $table = 'twitter_retweet';
  protected $fillable = ['tweet_id','twitter_id'];
}
