<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PurchaseController;
use App\Models\FollowUnfollowSetting;
use App\Models\Plans;
use App\Models\RetweetLikeSetting;
use App\Models\TwitterFollowersId;
use App\Models\TwitterFollowingId;
use App\Models\TwitterSidebar;
use App\Models\TwitterUnfollowersId;
use App\Models\TwitterUser;
use App\Models\UserPackageHistory;
use App\Models\UserPackages;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Twitter;
class TwitterAuthController extends Controller
{
  public function twitterLogin()
  {
    // your SIGN IN WITH TWITTER  button should point to this route
    $sign_in_twitter = true;
    $force_login = false;

    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
    Twitter::reconfig(['token' => '', 'secret' => '']);
    $token = Twitter::getRequestToken(route('twitter.callback'));

    if (isset($token['oauth_token_secret']))
    {
      $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

      Session::put('oauth_state', 'start');
      Session::put('oauth_request_token', $token['oauth_token']);
      Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

      return Redirect::to($url);
    }

    return Redirect::route('twitter.error');
  }

  public function twitterCallback(Request $request)
  {

    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
    if (Session::has('oauth_request_token'))
    {
      $request_token = [
        'token'  => Session::get('oauth_request_token'),
        'secret' => Session::get('oauth_request_token_secret'),
      ];

      Twitter::reconfig($request_token);

      $oauth_verifier = false;

      if (Input::has('oauth_verifier'))
      {
        $oauth_verifier = Input::get('oauth_verifier');
        // getAccessToken() will reset the token for you
        $token = Twitter::getAccessToken($oauth_verifier);
        //return $token;
      }

      if (!isset($token['oauth_token_secret']))
      {
        //return Redirect::route('twitter.error')->with('flash_error', 'We could not log you in on Twitter.');
        return redirect()->back()->with('error', 'Something wrong, please try again!');
      }

      $credentials = Twitter::getCredentials();

      if (is_object($credentials) && !isset($credentials->error))
      {
        $twitterInfo = Twitter::getUsers(['user_id' => $token['user_id'], 'format' => 'array']);

        //check userid exists
        $existsUserId = TwitterUser::checkExistsUserId($token['user_id']);
        
        if(count($existsUserId) > 0){
          if($existsUserId->token == $token['oauth_token'] && $existsUserId->secret == $token['oauth_token_secret']){
            
          }else{
            $updateUser = TwitterUser::updateUserTokenInfo($existsUserId->twitter_id,$token);
          }
        }else{
          $insertUser = TwitterUser::insertUser($token,$twitterInfo);
        }
        
        Session::put('twitterInfo', $twitterInfo);
        Session::put('twitter_access_token', $token);

        return redirect()->back()->with('success', 'Successfully login');

      }else{
      	return redirect()->back()->with('error', 'Something wrong, please try again!');
      }

    }
  }
  public function getTwitterUser($name)
  {
    try {
      $result['type'] = 'success';
      $twitterInfo = Twitter::getUsers(['screen_name' => $name, 'format' => 'array']);
      $result['value'] = $twitterInfo;
      return $result;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $result['type'] = 'error';
      $result['value'] = $bug1;
      return $result;
    }
    
  }

  public function getUserTimeline($name, $count)
  {
    try {
      return Twitter::getUserTimeline(['screen_name' => $name, 'count' => $count, 'format' => 'array']);
    } catch (\Exception $e) {
      return array();
    }
  }
  public function getTrendsAvailable($name)
  {
    try {
      //return Twitter::getTrendsClosest(['lat' => '23.810331', 'long' => '90.412521', 'format' => 'array']);
      return Twitter::getTrendsAvailable(['screen_name' => $name, 'format' => 'array']);
    } catch (\Exception $e) {
      return array();
    }
  }
  public function getMentionsTimeline($name)
  {
    try {
      $getMention = Twitter::getMentionsTimeline(['screen_name' => $name, 'format' => 'array']);
      foreach ($getMention as $mentionUser) {
        $data['id'] = $mentionUser->user->id;
        $data['name'] = $mentionUser->user->name;
        $data['screen_name'] = $mentionUser->user->screen_name;
        $data['image'] = $mentionUser->user->profile_image_url;
        $lastMention[] = $data;
      }
      return $lastMention;
    } catch (\Exception $e) {
      return array();
    }
  }
  public function twitterHome()
  {
  	if(Session::has('twitterInfo')){
      $twitterInfo = Session::get('twitterInfo');
      $twitterUser = TwitterUser::where('screen_name', $twitterInfo['screen_name'])->first();
      
      if($twitterUser->logged == 0){
        return redirect('twitter-setup');
      }
      //check sidebar and synchronize data
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($twitterInfo['id_str']);
      if(count($getSidebar) == 0){
        return redirect('twitter-resynchronize-data')->with('success', 'Please wait, system re synchronize your data');
      }else{
        if(time() - $getSidebar->session_time > 1800){
          return redirect('twitter-resynchronize-data')->with('success', 'Please wait, system re synchronize your data');
        }
      }
      $getUserTimeline = $this->getUserTimeline($twitterInfo['screen_name'], 5);
      $getTopics = $this->getTrendsAvailable($twitterInfo['screen_name']);
      $lastMention = $this->getMentionsTimeline($twitterInfo['screen_name']);
      $getFollowerId = TwitterFollowersId::where('fk_twitter_id', $twitterInfo['id_str'])->orderBy('id','desc')->paginate(30);

      $premium = false;
      $userType = 'free';
      $input['fk_user_id'] = Auth::user()->id;
      $planPurchase = $this->checkUserExistService($input);
      if($planPurchase['type'] == 'yes'){
        if($planPurchase['status'] == 0){
          return redirect('premium-account-set');
        }else{
          if($twitterInfo['id_str'] == $planPurchase['account_id']){
            $userType = 'premium';
            if($planPurchase['plan_category'] == 3){
              $premium = true;
            }
          }
        }
      }else{
        $planPurchase['id'] = 0;
      }
      $today = Carbon::today();
      $tFollowing =  TwitterFollowingId::where('fk_twitter_id', $twitterInfo['id_str'])->whereDate('created_at', $today)->count();
      $tFollowers =  TwitterFollowersId::where('fk_twitter_id', $twitterInfo['id_str'])->whereDate('created_at', $today)->count();
      $tUnfollowers = TwitterUnfollowersId::where('fk_twitter_id', $twitterInfo['id_str'])->whereDate('created_at', $today)->count();

      $unfollowersCount = TwitterUnfollowersId::where('fk_twitter_id', $twitterInfo['id_str'])->count();
      return view('backend.user.twitter.dashboard', compact('premium','getUserTimeline', 'getTopics', 'lastMention', 'getFollowerId', 'tFollowing', 'tFollowers', 'tUnfollowers', 'planPurchase', 'unfollowersCount', 'userType'));


    }else{
      return $this->twitterLogin();
    }
  }
  public function checkOutPremium($typeName, $packageName, $cat)
  {

    if($typeName == 'twitter'){
      
      $auth_user = Auth::user();
      $getPlan = Plans::checkExistsPlanNameWise($packageName);
      if(count($getPlan) > 0){
        return view('purchase.index', compact('getPlan', 'cat','auth_user'));    
      }else{
        return redirect('/')->with('error', 'Something error, please try again');
      }
    }
  }
  public function updateUserLogged($uId, $type)
  {
    try {
      //setup sidebar 
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($uId);
      $getBlacklist = TwitterFollowersId::getBlackListSelectTwitterId($uId);
      $getWhitelist = TwitterFollowingId::getWhiteListSelectTwitterId($uId);
      $getMutedId = Twitter::mutedUserIds(['user_id' => $uId, 'format' => 'array']);
      $getBlocksId = Twitter::getBlocksIds(['user_id' => $uId, 'format' => 'array']);
      $data = [
        'twitter_id'   => $uId,
        'blacklist'    => count($getBlacklist),
        'whitelist'    => count($getWhitelist),
        'muted'        => count($getMutedId),
        'blocked'      => count($getBlocksId),
        'updated_date' => date('Y-m-d'),
        'session_time' => time()

      ];
      if($type == 'manual'){
        $data['created_at'] = Carbon::now()->toDateTimeString();
      }
      if(count($getSidebar) > 0){
        if($getSidebar->updated_date == date('Y-m-d')){
          $data['sync_time'] = $getSidebar->sync_time + 1;
        }else{
          $data['sync_time'] = 1;
        }
        $getSidebar->update($data);
      }else{
        $data['sync_time'] = 1;
        TwitterSidebar::create($data);
      }
      //session setup getSidebar update data

      Session::forget('sidebar');
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($uId);
      Session::put('sidebar', $getSidebar);
      //setup logged
      $twitterInfo = Session::get('twitterInfo');
      $twitterUser = TwitterUser::where('screen_name', $twitterInfo['screen_name'])->first();
      $dataUpdate = [
        'logged' => 1
      ];
      $twitterUser->update($dataUpdate);
      //TwitterUser::updateUserLogged($uId);
      return "success";
    } catch (\Exception $e) {
      return "error";
    }
  }
  

  public function settings()
  {
    
    $premium = true;
    return view('backend.user.twitter.setting.index', compact('premium'));
    
  }
  public function settingsTypeWise($type)
  {
    $premium = true;
    $data['fk_user_id'] = Auth::user()->id;
    $checkPurchase = $this->checkUserExistService($data);
    if($checkPurchase['type'] == 'yes'){
      $hashtag = $checkPurchase['tag_limit'];
    }else{
      return redirect()->back()->with('error', 'Something wrong, please try again.');
    }
    if($type == 'follow-unfollow-setup'){
      $getData = FollowUnfollowSetting::getCheckExistsUserPackageId($checkPurchase['id']);
    }elseif($type == 'retweet-like-setup'){
      $getData = RetweetLikeSetting::getCheckExistsUserPackageId($checkPurchase['id']);
    }else{
      return redirect()->back()->with('error', 'Something wrong, please try again.');
    }
    return view('backend.user.twitter.setting.typewise', compact('type', 'getData', 'hashtag', 'premium'));
  }

  public function autoSystemSetup(Request $request)
  {
    $data['status'] = 'error';
    $input = $request->all();
    $user['fk_user_id'] = Auth::user()->id;
    $getPackage = $this->checkUserExistService($user);
    try {
      if($getPackage['type'] == 'yes'){
        $input['fk_package_id'] = $getPackage['id'];
        if($input['type'] == 'follow-unfollow-setup'){
          $getSetting = FollowUnfollowSetting::getCheckExistsUserPackageId($getPackage['id']);
          if(count($getSetting) > 0){
            $getData = FollowUnfollowSetting::findOrFail($getSetting->id);
            $getData->update($input);
          }else{
            FollowUnfollowSetting::create($input);
          }
        }elseif($input['type'] == 'retweet-like-setup'){
          $getSetting = RetweetLikeSetting::getCheckExistsUserPackageId($getPackage['id']);
          if(count($getSetting) > 0){
            $getData = RetweetLikeSetting::findOrFail($getSetting->id);
            $getData->update($input);
          }else{
            RetweetLikeSetting::create($input);
          }
        }else{
          $data['value'] = 'Something wrong';
          return $data;
        }
        $data['status'] = 'success';
        $data['value'] = 'Successfully set setting '.$input['type'];
        return $data;
      }
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $data['value'] = $bug1;
      return $data;
    }
    
  }

  public function followUnfollowSetup()
  {
    $data['fk_user_id'] = Auth::user()->id;
    $checkPurchase = $this->checkUserExistService($data);
    if($checkPurchase['type'] == 'yes'){
      $premium = true;
      $userSetting = UserSettingsPackage::checkSettingExistsUserId(Auth::user()->id);
      $hashtag = $checkPurchase['tag_limit'];
      return view('backend.user.twitter.settings', compact('premium', 'userSetting','hashtag'));
    }else{
      return redirect()->back()->with('error', 'Something wrong, please try again.');
    }
  }
  public function manualSettings()
  {
    if(Session::has('twitterInfo')){
      $input['fk_user_id'] = Auth::user()->id;
      $planPurchase = $this->checkUserExistService($input);
      if($planPurchase['status'] == 1){
        return redirect()->back()->with('error', 'Your are already setup your account');    
      }
      return view('backend.user.twitter.premium-setting');
    }else{
      return redirect('/dashboard', 'Please login your twitter account');
    }
  }
  public function manualSettingsConfirm(Request $request)
  {
    $input = $request->all();
    $input['fk_user_id'] = Auth::user()->id;
    $getPlan = $this->checkUserExistService($input);
    if($getPlan['type'] != 'yes'){
      return redirect()->back('error', "something wrong.");
    }
    DB::beginTransaction();
    try {
      
      $getPackage = UserPackages::findOrFail($getPlan['id']);
      $getPackageHistory = UserPackageHistory::getCheckUserPackageHistory($getPackage);
      $data = [
        'account_id' => $input['tid'],
        'status'     => 1,
        'updated_at' => Carbon::now()->toDateTimeString()
      ];

      
      $getPackage->update($data);
      $getPackageHistory->update($data);
      DB::commit();
      return redirect('twitter-dashboard');
    } catch (\Exception $e) {
      DB::rollback();
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      return redirect()->back('error', $bug1);
    }
  }
  public function settingsSetup(Request $request)
  {
    $data['status'] = 'error';
    $input = $request->all();
    $value['fk_user_id'] = Auth::user()->id;
    $input['user_id'] = Auth::user()->id;
    $userCheck = UserPackages::checkExistsPackage($value);
    
    $input['user_package_id'] = $userCheck->fk_package_id;
    DB::beginTransaction();
    try {
      //check exists setting this user
      $userSetting = UserSettingsPackage::checkSettingExistsUserId(Auth::user()->id);
      if(count($userSetting) > 0){
        //update setting
        $userPurchaseHistory = UserPurchaseHistory::checkUserPurchaseHistory($userSetting);
        $getPurchase = UserPurchaseHistory::findOrFail($userPurchaseHistory->id);
        $getPurchase->update($input);

        $getSetting = UserSettingsPackage::findOrFail($userSetting->id);
        $getSetting->update($input);
      }else{
        //create setting
        UserSettingsPackage::create($input);
        UserPurchaseHistory::create($input);
      }
      DB::commit();
      $data['status'] = 'success';
      $data['result'] = 'Successfully set settings';
      return $data;
    } catch (\Exception $e) {
      DB::rollback();
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $data['result'] = 'Something wrong, please try again.'.$bug1;
      return $data;
    }
  }
  public function logout()
  {
      Session::forget('twitterInfo');
      Session::forget('twitter_access_token');
      return redirect('/login');
  }
  
}
