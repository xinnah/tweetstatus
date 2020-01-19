<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TwitterTweets;
use App\Models\TwitterUser;
use Session;
use Twitter;
use DB;
class AutoTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:autoTweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule wise tweet on twitter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time = date('H:i');
        $date = date('Y-m-d');
        $getTweets = TwitterTweets::whereDate('date', $date)->where('time', $time.':00')->get();
        if(count($getTweets) > 0){
            foreach ($getTweets as $tweet) {
                $getTUser = TwitterUser::where('twitter_id', $tweet->fk_twitter_id)->first();
                $request_token = [
                  'token'  => $getTUser->token,
                  'secret' => $getTUser->secret,
                ];
                Twitter::reconfig($request_token);
                
                $credentials = Twitter::getCredentials();

                if (is_object($credentials) && !isset($credentials->error)){
                    Twitter::postTweet(['status' => $tweet->content, 'format' => 'json']);
                    $postTweet = TwitterTweets::findOrFail($tweet->id);
                    $postTweet->delete();
                    echo "success"; 
                }    
            } 
        }else{
            echo "no tweet found";
        }
        
        
    }
}
