<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use App\Models\TwitterFollowersId;
use App\Models\TwitterFollowingId;
use App\Models\TwitterSidebar;
use App\Models\TwitterUnfollowersId;
use App\Models\UserPackages;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Twitter;
use Yajra\Datatables\Facades\Datatables;
class TwitterGetDataController extends Controller
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
  
  public function followers()
  {
    $getId  = TwitterFollowersId::where('backlist', 0)->where('fk_twitter_id', $this->getId())->orderBy('id','desc')->paginate(30);
    $userType = $this->getUserType();
    return view('backend.user.twitter.followers_data', compact('getId', 'userType'));
  }

  public function unfollowers()
  {
    $getId  = TwitterUnfollowersId::where('fk_twitter_id', $this->getId())->orderBy('id','desc')->paginate(30);
    $userType = $this->getUserType();
    return view('backend.user.twitter.unfollowers_data', compact('getId', 'userType'));
  }

  public function following()
  {
    $getId  = TwitterFollowingId::where('fk_twitter_id', $this->getId())->orderBy('id','desc')->paginate(30);
    $userType = $this->getUserType();
    return view('backend.user.twitter.following_data', compact('getId','userType'));
  }
  public function getData(Request $request)
  {
    $results['getResult'] = array();
    if($this->checkOAuth() != 'success'){
      $results['result'] = 'error';
      return $results;
    }
    $input = $request->all();
    $data = $input['getIds'];
    try {
      
      $type = $input['type'];
      $getData='';
      if($type == 'muted' || $type == 'blocked'){
        $totalData = count($data['ids']);
        //return $totalData;
        for ($s=0; $s < $totalData; $s++) { 
          if($getData == ''){
            $getData = $data['ids'][$s];
          }else{
            $getData = $getData.','.$data['ids'][$s];
          }
        }
      }else{
        $totalData = count($data);
        for ($s=0; $s < $totalData; $s++) { 
          if($getData == ''){
            $getData = $data[$s]['twitter_id'];
          }else{
            $getData = $getData.','.$data[$s]['twitter_id'];
          }
        }  
      }
      if($totalData > 0){
        $results['getResult'] = Twitter::getUsersLookup(['user_id' => $getData]);
      }
      $results['result'] = 'success';
      return $results;
    } catch (\Exception $e) {
      $results['result'] = 'error';
      return $results;
    }
  }

  public function getLoadWise(Request $request)
  {
    $results['getResult'] = array();
    if($this->checkOAuth() != 'success'){
      $results['result'] = 'error';
      return $results;
    }
    $input = $request->all();

    try {
      if($input['start'] == 1){
        $startPage = 0;
        $totalGet = 0 + intval($input['perPage']);
      }else{
        $startPage = ($input['start'] - 1) * $input['perPage'];
        $totalGet = intval($startPage) + intval($input['perPage']);
      }

      if($input['type'] == 'i-dont-followback'){
        $data = TwitterFollowersId::where('backlist', 0)->where('fk_twitter_id', $this->getId())->orderBy('id','desc')->get();
      }elseif($input['type'] == 'non-followback'){
        $data = TwitterFollowingId::where('fk_twitter_id', $this->getId())->orderBy('id','desc')->get();
      }
      
      if($totalGet > count($data)){
        $totalGet = count($data);
      }
      $getData='';
      for ($s=intval($startPage); $s < intval($totalGet); $s++) { 
        if($getData == ''){
          $getData = $data[$s]['twitter_id'];
        }else{
          $getData = $getData.','.$data[$s]['twitter_id'];
        }
      }
      if($input['type'] == 'i-dont-followback'){
        $getAllData = Twitter::getUsersLookup(['user_id' => $getData]);
        $getAllDataCount = count($getAllData);
        for ($i=0; $i < $getAllDataCount; $i++) {
          if($getAllData[$i]->following != true){
            $results['getResult'][] = $getAllData[$i];
          }
        }
        
      }elseif($input['type'] == 'non-followback'){
        $getAllData = Twitter::getFriendshipsLookup(['user_id' => $getData]);
        $getTIds = '';
        for ($i=0; $i < count($getAllData); $i++) {
          $screen_name = $getAllData[$i]->name;
          $connectionLen = count($getAllData[$i]->connections);
          if($connectionLen > 1){

          }else{
            if($getAllData[$i]->connections[0] == 'following'){
              if($getTIds == ''){
                $getTIds = $getAllData[$i]->id;
              }else{
                $getTIds = $getTIds.','.$getAllData[$i]->id;
              }  
            }
            
            
          }

        }
        $results['getResult'] = Twitter::getUsersLookup(['user_id' => $getTIds]);
      }else{
        $results['result'] = 'error';
        return $results;
      }

      $results['result'] = 'success';
      return $results;

    } catch (\Exception $e) {
      $results['result'] = 'error';
      return $results;
    }

    
  }

  public function getNonfollowback(Request $request)
  {
    $results = array();
    if($this->checkOAuth() != 'success'){
      return $results;
    }
    $input = $request->all();
    $data = TwitterFollowingId::where('fk_twitter_id', $this->getId())->orderBy('id','desc')->get();

    if($input['start'] == 1){
      $startPage = 0;
      $totalGet = 0 + intval($input['perPage']);
    }else{
      $startPage = ($input['start'] - 1) * $input['perPage'];
      $totalGet = intval($startPage) + intval($input['perPage']);
    }
    
    if($totalGet > count($data)){
      $totalGet = count($data);
    }
    $getData='';
    for ($s=intval($startPage); $s < intval($totalGet); $s++) { 
      if($getData == ''){
        $getData = $data[$s]['twitter_id'];
      }else{
        $getData = $getData.','.$data[$s]['twitter_id'];
      }
    }
    $getData = Twitter::getFriendshipsLookup(['user_id' => $getData]);
    for ($i=0; $i < count($getData); $i++) {
      $screen_name = $getData[$i]->name;
      
      $connectionLen = count($getData[$i]->connections);
      if($connectionLen > 1){

      }else{
        $getData[$i]->following = true;
        $results['result'][] = $getData[$i];
      }

    }

    return $results;
    
  }
  

  public function search(Request $request)
  {
    $result['type'] = 'error';
    if($this->checkOAuth() != 'success'){
      $result['value'] = 'Please login again';
      return $result;
    }
    $input = $request->all();
    
    try {
      $result['type'] = 'success';
      $result['value'] = array();
      $x = 0;
      $data = array();
      while ( $x < 5 )
      {
        $dataLen = count($data);
        $getData = Twitter::getUsersSearch(['q' => $input['keyword'], 'page' => $x, 'format' => 'array']);

        $getDataLen = count($getData);
        if ( $getDataLen == 0 ){
          break;
        }else{
          if( $dataLen > 0){
            foreach ($getData as $value) {
              array_push($data, $value);
            }
          }else{
            $data = $getData;
          }
          if(count($getData) < 19){
            break;
          }
        }
        $x++;   
      }
      
      $length = count($data);
      if($input['location'] == null){
        for ($i = 0; $i < $length; $i++) {
          if($data[$i]['statuses_count'] >= $input['minTweet']  && $data[$i]['followers_count'] >= $input['minFollower']){
            $row['id'] = $data[$i]['id'];
            $row['following'] = $data[$i]['following'];
            $row['name'] = $data[$i]['name'];
            $row['screen_name'] = $data[$i]['screen_name'];
            $row['location'] = $data[$i]['location'];
            $row['followers_count'] = $data[$i]['followers_count'];
            $row['friends_count'] = $data[$i]['friends_count'];
            $row['listed_count'] = $data[$i]['listed_count'];
            $row['profile_image_url'] = $data[$i]['profile_image_url'];
            $result['value'][] = $row;   
          }  
        }  
      }else{
        for ($i = 0; $i < $length; $i++) {
          if($data[$i]['statuses_count'] >= $input['minTweet']  && $data[$i]['followers_count'] >= $input['minFollower'] && $data[$i]['location'] == $input['location']){
            $row['id'] = $data[$i]['id'];
            $row['following'] = $data[$i]['following'];
            $row['name'] = $data[$i]['name'];
            $row['screen_name'] = $data[$i]['screen_name'];
            $row['location'] = $data[$i]['location'];
            $row['followers_count'] = $data[$i]['followers_count'];
            $row['friends_count'] = $data[$i]['friends_count'];
            $row['listed_count'] = $data[$i]['listed_count'];
            $row['profile_image_url'] = $data[$i]['profile_image_url'];
            $result['value'][] = $row;   
          }  
        }
      }
      
      return $result; 

    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $result['value'] = $bug1;
      return $result;

    }
  }

  public function tweets(Request $request)
  {
    if($this->checkOAuth() != 'success'){
      $result['type'] = 'error';
      $result['value'] = 'please again twitter login';
      return $result;
    }
    $input = $request->all();
    
    try {
      $result['type'] = 'success';
      Twitter::postTweet(['status' => $input['content'], 'format' => 'json']);
      $result['value'] = 'Successfully Tweet Sent!.';
      return $result;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = Twitter::logs();
      $result['type'] = 'error';
      $result['value'] = $bug1.' '.$logs;
      return $result;
    }
    

    return $data;
  }

  public function tweetShare(Request $request)
  {
    if($this->checkOAuth() != 'success'){
      $result['type'] = 'error';
      $result['value'] = 'please again twitter login';
      return $result;
    }
    $input = $request->all();
    try {
      $result['type'] = 'success';
      Twitter::postTweet(['status' => $input['content'], 'format' => 'json']);
      $result['value'] = 'Successfully Tweet Sent!.';
      return $result;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = Twitter::logs();
      $result['type'] = 'error';
      $result['value'] = $bug1.' '.$logs;
      return $result;
    }
    

    return $data;
  }

  public function postFollow(Request $request)
  {
    $data['result'] = 'error';
    if($this->checkOAuth() != 'success'){
      $data['value'] = 'please again twitter login';
      return $data;
    }
    $input = $request->all();
    //0 = following action
    //1 = unfollowing action
    $row['fk_twitter_id'] = $this->getId();
    $row['twitter_id'] = $input['id'];
    try {
      $checkExists = TwitterFollowingId::where('fk_twitter_id', $this->getId())->where('twitter_id', $input['id'])->first();
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($this->getId());
      $getDataSet = [
        'twitter_id'   => $this->getId(),
        'ac_date'      => date('Y-m-d')
      ];
      $userType = $this->getUserType();
      $getPlane = Plans::checkFreePlaneLimitation();
      if($input['type'] == 0){
        if(count($getSidebar) > 0){
          if($getSidebar->ac_date == date('Y-m-d')){
            $getDataSet['ac_following'] = $getSidebar->ac_following + 1;
          }else{
            $getDataSet['ac_following'] = 1;
          }
        }else{
          $getDataSet['ac_following'] = 1;
        }
        if($userType == 'free'){
          if($getDataSet['ac_following'] > $getPlane->following){
            $data['value'] = 'Sorry! Your daily follow exceed.Go <a href="'.url('/plan').'"><b class="premium_text">Premium</b></a> for unlimited action';
            return $data;
          }
        }
        Twitter::postFollow(['user_id' => $input['id']]);
        if(count($checkExists) > 0){

        }else{
          TwitterFollowingId::create($row);
        }
        $data['value'] = true;
      }
      if($input['type'] == 1){
        if(count($getSidebar) > 0){
          if($getSidebar->ac_date == date('Y-m-d')){
            $getDataSet['ac_unfollowing'] = $getSidebar->ac_unfollowing + 1;
          }else{
            $getDataSet['ac_unfollowing'] = 1;
          }
        }else{
          $getDataSet['ac_unfollowing'] = 1;
        }
        if($userType == 'free'){
          if($getDataSet['ac_unfollowing'] > $getPlane->unfollowing){
            $data['value'] = 'Sorry! Your daily unfollow exceed.Go <a href="'.url('/plan').'"><b class="premium_text">Premium</b></a> for unlimited action';
            return $data;
          }
        }
        Twitter::postUnfollow(['user_id' => $input['id']]);
        if(count($checkExists) > 0){
          $getFollowing = TwitterFollowingId::findOrFail($checkExists->id);
          $getFollowing->delete();
        }
        $data['value'] = false;
      }
      $getSidebar->update($getDataSet);
      $data['result'] = 'success';
      return $data;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $logs = Twitter::logs();
      
      $data['value'] = $bug1.' '.$logs;
      return $data;
    }
    

    return $data;
  }
  public function mutedIds()
  {
    if($this->checkOAuth() != 'success'){
      return "error";
    }
    try {
      $getId = Twitter::mutedUserIds(['user_id' => $this->getId(), 'format' => 'array']);

      return $getId;
    } catch (\Exception $e) {
      return "error";
    }
    
  }
  public function muted()
  {
    $getId = $this->mutedIds();
    if($getId != "error"){
      $userType = $this->getUserType();
      return view('backend.user.twitter.muted', compact('getId', 'userType'));
    }else{
      return redirect()->back()->with('error', 'Something wrong, please try again');
    }
    
  }
  public function postMute(Request $request)
  {
    $data = array();
    $data['result'] = 'error';
    if($this->checkOAuth() != 'success'){
      $data['value'] = 'please again twitter login';
      return $data;
    }
    $input = $request->all();
    
    //0 = muted action
    //1 = unmuted action
    $userType = $this->getUserType();
    $getPlane = Plans::checkFreePlaneLimitation();

    $getSidebar = TwitterSidebar::getCheckThisAccountExist($this->getId());
    $getDataSet = [
      'twitter_id'   => $this->getId(),
      'ac_date'      => date('Y-m-d')
    ];
    if($input['type'] == 0){
      if($getSidebar->ac_date == date('Y-m-d')){
        $getDataSet['ac_mute'] = $getSidebar->ac_mute + 1;
      }else{
        $getDataSet['ac_mute'] = 1;
      }
      if($userType == 'free'){
        if($getDataSet['ac_mute'] > $getPlane->mute){
          $data['value'] = 'Sorry! Your daily mute exceed.Go <a href="'.url('/plan').'"><b class="premium_text">Premium</b></a> for unlimited action';
          return $data;
        }
      }
      Twitter::muteUser(['user_id' => $input['id']]);
      $getSidebar->update($getDataSet);
      $data['result'] = 'success';
      $data['value'] = true;
    }
    if($input['type'] == 1){
      Twitter::unmuteUser(['user_id' => $input['id']]);
      
      $data['result'] = 'success';
      $data['value'] = false;
    }

    return $data;
  }
  public function blockIds()
  {
    if($this->checkOAuth() != 'success'){
      return "error";
    }
    try {
      $getId = Twitter::getBlocksIds(['user_id' => $this->getId(), 'format' => 'array']);

      return $getId;
    } catch (\Exception $e) {
      return "error";
    }
    
  }
  public function blocked()
  {

    if($this->checkOAuth() != 'success'){
      return redirect()->back()->with('error', 'Something wrong, please try again.');
    }
    $getId = Twitter::getBlocksIds(['user_id' => $this->getId(), 'format' => 'array']);
    $userType = $this->getUserType();
    return view('backend.user.twitter.blocked', compact('getId', 'userType'));
    
  }
  public function postBlock(Request $request)
  {
    $data = array();
    $data['result'] = 'error';
    if($this->checkOAuth() != 'success'){
      $data['value'] = 'please again twitter login';
      return $data;
    }
    $input = $request->all();
    //0 = block action
    //1 = unblock action
    $getSidebar = TwitterSidebar::getCheckThisAccountExist($this->getId());
    $getDataSet = [
      'twitter_id'   => $this->getId(),
      'ac_date'      => date('Y-m-d')
    ];
    $userType = $this->getUserType();
    $getPlane = Plans::checkFreePlaneLimitation();
    try {
      if($input['type'] == 0){
        if($getSidebar->ac_date == date('Y-m-d')){
          $getDataSet['ac_block'] = $getSidebar->ac_block + 1;
        }else{
          $getDataSet['ac_block'] = 1;
        }

        if($userType == 'free'){
          if($getDataSet['ac_block'] > $getPlane->block){
            $data['value'] = 'Sorry! Your daily block exceed.Go <a href="'.url('/plan').'"><b class="premium_text">Premium</b></a> for unlimited action';
            return $data;
          }
        }
        Twitter::postBlock(['user_id' => $input['id']]);
        $getSidebar->update($getDataSet);
        $data['result'] = 'success';
        $data['value'] = true;
      }
      if($input['type'] == 1){
        Twitter::destroyBlock(['user_id' => $input['id']]);
        
        $data['result'] = 'success';
        $data['value'] = false;
      }
      return $data;
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $data['result'] = 'error';
      $data['value'] = $bug1;
    }
    
  }

  public function checkUser(Request $request)
  {
    $data['status'] = 'error';
    if($this->checkOAuth() != 'success'){
      return $data;
    }
    $input = $request->all();
    try {
      $data['status'] = 'success';
      $user = Twitter::getUsersSearch(['q' => $input['username']]);
      if(count($user) > 0){
        $data['result'] = Twitter::ago($user[0]->created_at);
      }else{
        $data['result'] = "no";
      }
      return $data;
    } catch (\Exception $e) {
      $data['status'] = 'error';
      return $data;
    }
  }

  public function checkFriendship(Request $request)
  {
    $data['status'] = 'error';
    if($this->checkOAuth() != 'success'){
      $data['result'] = "Auth error, please again login";
      return $data;
    }
    $input = $request->all();
    if($input['username1'] == null || $input['username1'] == ''){
      $data['result'] = 'username 1 not null';
      return $data;
    }
    if($input['username2'] == null || $input['username2'] == ''){
      $data['result'] = 'username 2 not null';
      return $data;
    }
    try {
      $results = Twitter::getFriendships(['source_screen_name' => $input['username1'], 'target_screen_name' =>$input['username2']]);
      $source = $results->relationship->source;
      $target = $results->relationship->target;
      if($source->following == true && $target->following == true){
        $data['result'] = '@'.$source->screen_name.' and '.'@'.$target->screen_name.' are both following each other.';
      }elseif($source->following == true && $target->following == false){
        $data['result'] = '@'.$source->screen_name.' is following but '.'@'.$target->screen_name.' is not following back.';
      }elseif($source->following == false && $target->following == true){
        $data['result'] = '@'.$target->screen_name.' is following but '.'@'.$source->screen_name.' is not following back.';
      }elseif($source->following == false && $target->following == false){
        $data['result'] = '@'.$source->screen_name.' and '.'@'.$target->screen_name.' do not follow the other one.';
      }else{
        $data['result'] = "Something wrong, please try again.";
      }
      $data['status'] = 'success';
      return $data;
    } catch (\Exception $e) {
      $data['result'] = "Something wrong, please try again.";
      return $data;
    }
    
  }

  public function footerAction()
  {
    $getSidebar = TwitterSidebar::getCheckThisAccountExist($this->getId());
    if(count($getSidebar) > 0){
      $today = date("Y-m-d");
      if($getSidebar->ac_date == $today){
        $action = $getSidebar->ac_following + $getSidebar->ac_unfollowing + $getSidebar->ac_block + $getSidebar->ac_mute;
      }else{
        $action = 0;
      }
    }else{
      $action = 0;
    }
    return $action;
  }
  
}
