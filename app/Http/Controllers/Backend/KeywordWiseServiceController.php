<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Models\Plans;
use App\Models\UserPackages;
use Session;
use Twitter;
use App\Models\TwitterUser;
use App\Models\FollowUnfollowSetting;
use App\Models\RetweetLikeSetting;
use App\Models\TwitterFollowingId;

use Auth;
use Carbon\Carbon;
class KeywordWiseServiceController extends Controller
{
  public function getId(){
    $authInfo = Session::get('twitter_access_token');
    $token = $authInfo['oauth_token'];
    $secret = $authInfo['oauth_token_secret'];
    $id = $authInfo['user_id'];
    return $id;
  }
  public function screen_name(){
    $authInfo = Session::get('twitter_access_token');
    $token = $authInfo['oauth_token'];
    $secret = $authInfo['oauth_token_secret'];
    $screen_name = $authInfo['screen_name'];
    return $screen_name;
  }
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

  public function getAppRateLimit()
  {
    return Twitter::getAppRateLimit();
  }

  public function typeFollow($pId, $updated_at)
  {
    $getSetting = FollowUnfollowSetting::getCheckExistsUserPackageId($pId);
    if(count($getSetting) > 0){
      $keyword = $getSetting->search_keyword;
      $d = Carbon::parse($updated_at)->format("Y-m-d");
      $pageNo = Carbon::parse($d)->diffInDays() + 1;
      return view('backend.service-admin.follow-page', compact('keyword','pageNo'));
    }else{
      return redirect()->back()->with('error', 'something wrong');
    }
  }

  public function typeUnFollow($pId, $updated_at)
  {
    $getSetting = FollowUnfollowSetting::getCheckExistsUserPackageId($pId);
    if(count($getSetting) > 0){
      $unfollowBackData = explode('-', $getSetting->unfollow_back);
      $unfollowStatus = $unfollowBackData[0];
      if($unfollowStatus == 'true'){
        $action = $unfollowBackData[1];
      }elseif($unfollowStatus == 'false'){
        $action = '0';
      }else{
        return redirect()->back()->with('error', 'User setting not setup');
      }
      $actionStatus = 0;
      if($action != '0'){
        $setupDate = Carbon::parse($updated_at)->format("Y-m-d");
        $unfollowBackDate = date('Y-m-d',strtotime("-$action days"));
        //return $setupDate;
        if($setupDate > $unfollowBackData){
          $actionStatus = 1;
        }
      }
      if($actionStatus == 1){
        $query = TwitterFollowingId::where('fk_twitter_id', $token['twitter_id'])->whereDate('created_at', $unfollowBackData)->orderBy('id','desc')->get();
      }else{
        $query = array();
      }
      return view('backend.service-admin.unfollow-page', compact('query'));
    }else{
      return redirect()->back()->with('error', 'something wrong');
    }
  }

  public function typeRetweet($pId, $updated_at)
  {
    return redirect()->back()->with('error', 'not found');
    
    $getSetting = RetweetLikeSetting::getCheckExistsUserPackageId($pId);
    if(count($getSetting) > 0){
      $keyword = $getSetting->search_keyword;
      $retweetStatusData = explode('-', $getSetting->retweet_daily);
      if(count($retweetStatusData) > 1){
        $retweetStatus = $retweetStatusData[0];
        $retweetDaily = $retweetStatusData[1];
        if($retweetStatus == 'true'){
          $retweetLimit = $retweetDaily;
        }else{
          $retweetLimit = '0';
        }

        if($retweetLimit == '0'){
          $keyword = array();
        }
        $d = Carbon::parse($updated_at)->format("Y-m-d");
        $pageNo = Carbon::parse($d)->diffInDays() + 1;
        return view('backend.service-admin.retweet-page', compact('keyword', 'retweetLimit', 'pageNo'));
      }
      return $retweetStatus;
    }else{
      return redirect()->back()->with('error', 'user not setup setting');
    }
    
  }

  public function typeWise($type)
  {
    try {
      if(Session::has('twitter_access_token')){
        $token = Session::get('twitter_access_token');
        $getPackage = UserPackages::getExistsUserPackage($token);
        if(count($getPackage) > 0){
          $today = date('Y-m-d');
          if($getPackage->end_date >= $today){
            if($type == 'follow'){
              return $this->typeFollow($getPackage->id, $getPackage->updated_at);
            }elseif($type == 'unfollow'){
              return $this->typeUnFollow($getPackage->id, $getPackage->updated_at);
            }elseif($type == 'retweet'){
              return $this->typeRetweet($getPackage->id, $getPackage->updated_at);
            }
          }
        }
      }
      return redirect()->back()->with('error', 'Something wrong, please try again');

    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Something wrong, please try again');
    }
  }
  

  public function followResult(Request $request)
  {
  	$input = $request->all();

  	$data['status'] = 'error';
    if($this->checkOAuth() != 'success'){
      $data['result'] = 'Auth error, please again login twitter';
      return $data;
    }
  	try {
  		$data['status'] = 'success';
  		$searchQuery = Twitter::getUsersSearch(['q' => $input['keyword'], 'count' => 20, 'page' => $input['pno'], 'format' => 'array']);
  		$length = count($searchQuery);
  		$results = array();
	    for ($i = 0; $i < $length; $i++) { 
	      $row['id'] = $searchQuery[$i]['id'];
	      $row['following'] = $searchQuery[$i]['following'];
	      $row['name'] = $searchQuery[$i]['name'];
	      $row['screen_name'] = $searchQuery[$i]['screen_name'];
	      $row['location'] = $searchQuery[$i]['location'];
	      $row['followers_count'] = $searchQuery[$i]['followers_count'];
	      $row['friends_count'] = $searchQuery[$i]['friends_count'];
	      $row['listed_count'] = $searchQuery[$i]['listed_count'];
	      $row['profile_image_url'] = $searchQuery[$i]['profile_image_url'];
	      $results[] = $row;  
	    }
  		$data['result'] = $results;
  		return $data;
  	} catch (\Exception $e) {
  		$bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
  		$logs = Twitter::logs();
  		$data['result'] = $bug1.' '.$logs;
  		return $data;
  	}
  }


  public function unfollowResult(Request $request)
  {
    $data['status'] = 'error';
    // if($this->checkOAuth() != 'success'){
    //   $data['result'] = 'Auth error, please again login twitter';
    //   return $data;
    // }
    $input = $request->all();
    $query = $input['unfollowlist'];
    try {
      $data['status'] = 'success';
      $getData='';
      $countQuery = count($query);
      if($countQuery > 100){
        $countQuery = 100;
      }
      for ($s=0; $s < $countQuery; $s++) { 
        if($getData == ''){
          $getData = $query[$s]['twitter_id'].',';
        }else{
          $getData = $getData.','.$query[$s]['twitter_id'];
        }
      }
      $getData = Twitter::getFriendshipsLookup(['user_id' => $getData]);
      $data['result'] = array();
      for ($i=0; $i < count($getData); $i++) {
        $screen_name = $getData[$i]->name;
        
        $connectionLen = count($getData[$i]->connections);
        if($connectionLen > 1){

        }else{
          if($getAllData[$i]->connections[0] == 'following'){
            $getData[$i]->following = true; 
            $data['result'][] = $getData[$i];
          }
        }

      }
      return $data;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = dd(Twitter::logs());
      $data['result'] = $bug1.' '.$logs;
      return $data;
    }
  }

  public function retweetResult(Request $request)
  {
    $input = $request->all();
    $getSearch = Twitter::getSearch(['q' => $input['keyword'], 'count' => 20]);
    echo "<pre>"; print_r($getSearch);exit;
  }
  public function autoFollow(Request $request)
  {
    if($this->checkOAuth() != 'success'){
      $data['result'] = 'error';
      $data['value'] = 'Auth error, please again login twitter';
      return $data;
    }
    $input = $request->all();
    $row['fk_twitter_id'] = $this->getId();
    $row['twitter_id'] = $input['id'];
    try {
      $checkExists = TwitterFollowingId::where('fk_twitter_id', $this->getId())->where('twitter_id', $input['id'])->first();
    
      if($input['type'] == 0){
        Twitter::postFollow(['user_id' => $input['id']]);
        if(count($checkExists) > 0){

        }else{
          TwitterFollowingId::create($row);
        }
        $data['value'] = true;
      }
      
      $data['result'] = 'success';
      return $data;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = Twitter::logs();
      $data['result'] = 'error';
      $data['value'] = $bug1.' '.$logs;
      return $data;
    }
    
  }
  public function autoUnfollow(Request $request)
  {
    if($this->checkOAuth() != 'success'){
      $data['result'] = 'error';
      $data['value'] = 'Auth error, please again login twitter';
      return $data;
    }
    $input = $request->all();

    $row['fk_twitter_id'] = $this->getId();
    $row['twitter_id'] = $input['id'];
    try {
      $checkExists = TwitterFollowingId::where('fk_twitter_id', $this->getId())->where('twitter_id', $input['id'])->first();

      if($input['type'] == 1){
        Twitter::postUnfollow(['user_id' => $input['id']]);
        if(count($checkExists) > 0){
          $getFollowing = TwitterFollowingId::findOrFail($checkExists->id);
          $getFollowing->delete();
        }
        $data['value'] = false;
      }
      $data['result'] = 'success';
      return $data;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = Twitter::logs();
      $data['result'] = 'error';
      $data['value'] = $bug1.' '.$logs;
      return $data;
    }

  }
}
