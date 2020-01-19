<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\TwitterFollowingId;
use App\Models\TwitterFollowersId;
use App\Models\TwitterUnfollowersId;
use App\Models\UserPackages;
use Session;
use Auth;
use Twitter;
use Carbon\Carbon;
class TwitterActivityReportController extends Controller
{
	public function checkOAuth()
  {
    $authInfo = Session::get('twitter_access_token');
    $token = $authInfo['oauth_token'];
    $secret = $authInfo['oauth_token_secret'];
    if ($token)
    {
      $request_token = [
        'token'  => $token,
        'secret' => $secret,
      ];

      Twitter::reconfig($request_token);

      $oauth_verifier = false;

      if (Input::has('oauth_verifier'))
      {
        $oauth_verifier = Input::get('oauth_verifier');
        // getAccessToken() will reset the token for you
        $token = Twitter::getAccessToken($oauth_verifier);
      }

      if (!$secret)
      {
        return 'error';
      }

      $credentials = Twitter::getCredentials();

      if (is_object($credentials) && !isset($credentials->error))
      {
        return 'success';
      } 
    }
  }
  public function dailyReports(Request $request, $pid)
  {
    if($this->checkOAuth() != 'success'){
      $results['type'] = 'error';
      $results['value'] = 'please twitter login again';
      return $results;
    }
    if($pid == 0){
    	$diffDate = 4;
      $twitterInfo = Session::get('twitterInfo');
    	$setting['account_id'] = $twitterInfo['id_str']; 
    }else{
    	$setting = UserPackages::findOrFail($pid);

	  	$joinDate = $setting['start_date'];
	  	$cDate = Carbon::parse($joinDate);
			$diffDate = $cDate->diffInDays();

    }
  	
		if($diffDate > 4){
			$diffDate = 4;
		}
		
		$totalFollow = 0;
		$totalUnfollow = 0;
		$results['type'] = 'success';
			if($diffDate != 0){
				for ($i=0; $i < $diffDate; $i++) {
					$cdate =  date('Y-m-d',strtotime("-$i days"));
					$dateIn =  date('d-m-Y',strtotime("-$i days"));
					$tFollowing =  TwitterFollowingId::where('fk_twitter_id', $setting['account_id'])->whereDate('created_at', $cdate)->get();
					$tUnfollowers = TwitterUnfollowersId::where('fk_twitter_id', $setting['account_id'])->whereDate('created_at', $cdate)->count();
					$tfollowers = TwitterFollowersId::where('fk_twitter_id', $setting['account_id'])->whereDate('created_at', $cdate)->count();
					$totalUnfollowers[] = $tUnfollowers;
					$totalFollowers[] = $tfollowers;
					$getFIds = '';
					
					//following section
					if(count($tFollowing) > 0){
						$TfCount = 0;
						$totalFollowing = count($tFollowing);
						if(count($tFollowing) > 99){
							$totalFollowing = 100;
						}
						for ($f=0; $f < $totalFollowing; $f++) { 
							++$TfCount;
				      if($getFIds == ''){
				        $getFIds = $tFollowing[$f]->twitter_id;
				      }else{
				        $getFIds = $getFIds.','.$tFollowing[$f]->twitter_id;
				      }
				    }
				    
				    $getAllData = Twitter::getFriendshipsLookup(['user_id' => $getFIds]);
						

				    $back = 0;
		        for ($b=0; $b < count($getAllData); $b++) {
		          $connectionLen = count($getAllData[$b]->connections);
		          if($connectionLen > 1){
		          	++$back;
		          	
		          }
		        }
		        $follow_back = $back;
		        $non_followback = count($tFollowing) - $follow_back;
					}else{
						$follow_back = 0;
						$non_followback = 0;
					}
					$totalFollow += $follow_back;
					$totalUnfollow += $non_followback;
					$followback[] = $follow_back;
					$unfollowBack[] = $non_followback;
					//$dateInclude = $dateInclude.','."'".$dateIn."'";
					$dateInclude[] = $dateIn;
				}
			}else{
				$dateInclude = [];
				$totalFollow = [];
				$totalUnfollow = [];
				$followback[] = [];
				$unfollowBack = [];
				$totalFollowers = [];
				$totalUnfollowers = [];
			}
			
			//query following get data
			$data['date'] = $dateInclude;
			$data['followback'] = $followback;
			$data['unfollowBack'] = $unfollowBack;
			$data['totalFollow'] = $totalFollow;
			$data['totalUnfollow'] = $totalUnfollow;
			$data['totalUnfollowers'] = $totalUnfollowers;
			$data['totalFollowers'] = $totalFollowers;
			$data['premium'] = $this->premiumCheck();
			$results['value'] = $data;
			return $results;
		try {
			
		} catch (\Exception $e) {
			$bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $results['value'] = $bug1;
			return $results;
		}
		
		
		
  }
}
