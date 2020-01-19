<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TwitterFollowersId;
use App\Models\TwitterFollowingId;
use App\Models\TwitterSidebar;
use App\Models\TwitterUnfollowersId;
use App\Models\TwitterUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Twitter;
use Yajra\Datatables\Facades\Datatables;
class TwitterSetupController extends Controller
{
  public function getId(){
    $twitterInfo = Session::get('twitterInfo');
    $id = $twitterInfo['id_str'];
    return $id;
  }
  public function screen_name(){
    $twitterInfo = Session::get('twitterInfo');
    $screen_name = $twitterInfo['screen_name'];
    return $screen_name;
  }
  

  public function follower()
  {
    if($this->checkOAuth() != 'success'){
      return 'error';
    }
    $getId = $this->getId();
    echo "follower";
    //echo $getId;
  	try {
  		$getData = Twitter::getFollowersIds(['user_id' => $getId, 'format' => 'array']);
  		$getResult = array_reverse($getData['ids']);
      return $getResult;
      
  	} catch (\Exception $e) {
  		return 'error';
  	}
  }
  
  public function following()
  {
    if($this->checkOAuth() != 'success'){
      return 'error';
    }
    $getId = $this->getId();
    echo "following";
    try {
      $getData = Twitter::getFriendsIds(['user_id' => $getId, 'format' => 'array']);
      $getResult = array_reverse($getData['ids']);
      return $getResult;
      
    } catch (\Exception $e) {
      return 'error';
    }
  }
  public function dataIdList(Request $request)
  {
    $getId = $this->getId();
    echo "data";
    $input = $request->all();
    try {
      $startPage = ($input['start']) * $input['pPage'];
      $totalGet = intval($startPage) + intval($input['pPage']);
      $dataIds = $input['data'];
      if($totalGet > count($dataIds)){
        $totalGet = count($dataIds);
      }
      if($input['type'] == 'followers'){
        for ($i = intval($startPage); $i < intval($totalGet); $i++) { 
          $row['fk_twitter_id'] = $getId;
          $row['twitter_id'] = $dataIds[$i];
          $checkExists = TwitterFollowersId::checkExistsTwitterUser($getId, $dataIds[$i]);
          if(count($checkExists) > 0){

          }else{
            TwitterFollowersId::create($row);
          }
        }
      }else{
        for ($i = intval($startPage); $i < intval($totalGet); $i++) { 
          $row['fk_twitter_id'] = $getId;
          $row['twitter_id'] = $dataIds[$i];
          $checkExists = TwitterFollowingId::checkExistsTwitterUser($getId, $dataIds[$i]);
          if(count($checkExists) > 0){

          }else{
            TwitterFollowingId::create($row);
          }  
        }
      }
      
      return 'success';
    } catch (\Exception $e) {
      $bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      return 'error '.$bug1;
    }
  }
  public function followersDiffs()
  {
    $getId = $this->getId();
    echo "follower";
    $data['type'] = 'error';
    try {
      $getData = Twitter::getFollowersIds(['user_id' => $getId, 'format' => 'array']);
      $serverData = $getData['ids'];
      $dbData = TwitterFollowersId::getUserWiseFollowersId($getId);
      $totalDbData = count($dbData);
      $dbResult = array();
      for ($i=0; $i < $totalDbData; $i++) { 
        $dbResult[$i] = $dbData[$i]->twitter_id;
      }
      $diff = array_diff($dbResult,$serverData);
      //unfollowers section setup
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($getId);

      $getDataSet = [
        'twitter_id' => $getId,
        'unfollowers'  => count($diff),
        'followers' => count($serverData)
      ];

      $getDataSet['followers_new'] = 0;
      if(count($getSidebar) > 0){
        if($getSidebar->followers != null){
          if($getSidebar->followers > count($serverData)){
            $getDataSet['followers_new'] = 0;
          }else{
            $getDataSet['followers_new'] = count($serverData) - $getSidebar->followers;
          }
        }
        $getSidebar->update($getDataSet);
      }else{
        TwitterSidebar::create($getDataSet);
      }
      
      //store in unfollowers table if not existed
      foreach ($diff as $unfollowCreate) {
        $getUnfollower = TwitterUnfollowersId::where('fk_twitter_id', $getId)->where('twitter_id', $unfollowCreate)->first();
        if(count($getUnfollower)){

        }else{
          $insertUnfollow = [
            'fk_twitter_id' => $getId,
            'twitter_id'    => $unfollowCreate
          ];
          TwitterUnfollowersId::create($insertUnfollow);
        }
      }
      $data['type'] = 'success';
      $data['value'] = $diff;
      return $data;
    } catch (\Exception $e) {
      $data['value'] = 'something wrong';
      return $data;
    }
  }
  public function removeIds(Request $request)
  {
    $getId = $this->getId();
    echo "removeIds";
    $input = $request->all();
    try {
      if($input['type'] == 'followers'){
        $getDiffData = $this->followersDiffs();
        if($getDiffData['type'] == 'success'){
          $getDiff = $getDiffData['value'];
          //delete form followers list/table
          foreach ($getDiff as $key => $value) {
            $dataDelete[$key] = TwitterFollowersId::where('fk_twitter_id', $getId)->where('twitter_id', $getDiff[$key])->first();
            $dataDelete[$key]->delete();
          }
        }
      }else{
        $getData = Twitter::getFriendsIds(['user_id' => $getId, 'format' => 'array']);
        $serverData = $getData['ids'];
        $dbData = TwitterFollowingId::getUserWiseFollowingId($this->getId());
        $totalDbData = count($dbData);
        $dbResult = array();
        for ($i=0; $i < $totalDbData; $i++) { 
          $dbResult[$i] = $dbData[$i]->twitter_id;
        }
        $diff = array_diff($dbResult,$serverData);
        $getSidebar = TwitterSidebar::getCheckThisAccountExist($getId);
        $friends_count = count($serverData);
        $getDataSet = [
          'twitter_id'     => $getId,
          'following'      => $friends_count
        ];
        $getDataSet['following_new'] = 0;
        if(count($getSidebar) > 0){
          if($getSidebar->following != null){
            if($getSidebar->following > $friends_count){

              $getDataSet['following_new'] = 0;
            }else{
              $getDataSet['following_new'] = $friends_count - $getSidebar->following;
            }
          }
          $getSidebar->update($getDataSet);
        }else{
          TwitterSidebar::create($getDataSet);
        }

        //delete extra id form following table
        foreach ($diff as $key => $value) {
          $dataDelete[$key] = TwitterFollowingId::where('fk_twitter_id', $getId)->where('twitter_id', $diff[$key])->first();
          $dataDelete[$key]->delete();
        }
      }
      
      return 'success';
    } catch (\Exception $e) {
      return 'error';
    }
  }


  public function setupComplete()
  {
    $getScreenName = $this->screen_name();
    echo "complete";
    try {

      $twitterUser = TwitterUser::where('screen_name', $getScreenName)->first();
      $dataUpdate = [
        'logged' => 1
      ];
      $twitterUser->update($dataUpdate);
      return 'success';
    } catch (\Exception $e) {
      return 'error';
    }
  }

  public function updateComplete($type)
  {
    if($this->checkOAuth() != 'success'){
      $results['result'] = 'error';
      return $results;
    }
    $getId = $this->getId();
    echo "complete";
    try {
      //setup sidebar 
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($getId);
      $getBlacklist = TwitterFollowersId::getBlackListSelectTwitterId($getId);
      $getWhitelist = TwitterFollowingId::getWhiteListSelectTwitterId($getId);
      $getMutedId = Twitter::mutedUserIds(['user_id' => $getId, 'format' => 'array']);
      
      $getBlocksId = Twitter::getBlocksIds(['user_id' => $getId, 'format' => 'array']);
      $data = [
        'twitter_id'   => $getId,
        'blacklist'    => count($getBlacklist),
        'whitelist'    => count($getWhitelist),
        'muted'        => count($getMutedId['ids']),
        'blocked'      => count($getBlocksId['ids']),
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
      $getSidebar = TwitterSidebar::getCheckThisAccountExist($getId);
      Session::put('sidebar', $getSidebar);

      $results['result'] = 'success';
      return $results;
    } catch (\Exception $e) {
      $results['result'] = 'error';
      return $results;
    }
  }
}
