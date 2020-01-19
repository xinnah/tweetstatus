<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use App\Models\TwitterFollowersId;
use App\Models\TwitterFollowingId;
use App\Models\UserFollowingMsg;
use App\Models\UserPackages;
use App\Models\TwitterSidebar;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Twitter;
class TwitterUrlController extends Controller
{
    public function twitterAuthId()
    {
      $result['type'] = 'error';
      try {
        if(Session::has('twitterInfo')){
          $result['type'] = 'success';
          $twitterInfo = Session::get('twitterInfo');
          $result['value'] = $twitterInfo['id_str'];
        }else{
          $result['value'] = 'please login again';
        }
        return $result;
      } catch (\Exception $e) {
        $bug = $e->errorInfo[1];
        $bug1 = $e->errorInfo[2];
        $result['value'] = $bug1;
        return $result;
      }
    }

    public function twitterAuthScreen_name()
    {
      $result['type'] = 'error';
      try {
        if(Session::has('twitterInfo')){
          $result['type'] = 'success';
          $twitterInfo = Session::get('twitterInfo');
          $result['value'] = $twitterInfo['screen_name'];
        }else{
          $result['value'] = 'please login again';
        }
        return $result;
      } catch (\Exception $e) {
        $bug = $e->errorInfo[1];
        $bug1 = $e->errorInfo[2];
        $result['value'] = $bug1;
        return $result;
      }
    }
    
    public function setupTwitter()
    {
      if(Session::has('twitterInfo')){
          $user = Session::get('twitterInfo');
          $userType = $this->getUserType();
          return view('backend.user.twitter.setup', compact('user', 'userType'));
      }else{
        return redirect('/dashboard')->with('error', 'Something error, please try again');
      }
      
    }

    public function updateTwitter()
    {
	    if(Session::has('twitterInfo')){
        $user = Session::get('twitterInfo');
        $userType = $this->getUserType();
        return view('backend.user.twitter.update', compact('user', 'userType'));
      }else{
        return redirect('/dashboard')->with('error', 'Something error, please try again');
      }
	    
	  }
    public function resynchronize()
    {
      if(Session::has('twitterInfo')){
        $user = Session::get('twitterInfo');
        return view('backend.user.twitter.resynchronize', compact('user'));
      }else{
        return redirect('/dashboard')->with('error', 'Something error, please try again');
      }
      
    }

	  public function nonFollowback()
	  {
      $userType = $this->getUserType();
      return view('backend.user.twitter.non-followback', compact('userType'));
    }

    public function iDontFollowback()
    {
      $userType = $this->getUserType();
      return view('backend.user.twitter.i-dont-followback', compact('userType'));
    }
    public function getTrendsAvailable($tId)
    {
      try {
        return Twitter::getTrendsAvailable(['id' => $tId, 'format' => 'array']);
      } catch (\Exception $e) {
        return array();
      }
    }
    public function search(Request $request)
    {
      $title = 'Search Follower';
      $input = $request->all();
      if(count($input) <= 6){
        $getResult = $input;
      }else{
        $getResult = [];
      }
      
      $tStatus = $this->twitterAuthId();
      if($tStatus['type'] == 'success'){
        $tAuthId = $tStatus['value'];
        $getTopics = $this->getTrendsAvailable($tAuthId);
      }else{
        return redirect('/dashboard')->with('error', $tStatus['value']);
      }
      $userType = $this->getUserType();
      return view('backend.user.twitter.search', compact('getResult', 'getTopics', 'userType'));
    }
    public function joined()
    {
      $userType = $this->getUserType();
      return view('backend.user.twitter.joined', compact('userType'));
    }
    public function friendshipCheck()
    {
      $userType = $this->getUserType();
      return view('backend.user.twitter.friendship_check', compact('userType'));
    }

    public function whitelist()
    {
      $tStatus = $this->twitterAuthId();
      if($tStatus['type'] == 'success'){
        $tAuthId = $tStatus['value'];
        $getList = TwitterFollowingId::getWhiteListSelectTwitterId($tAuthId);
        $title = 'whitelist';
        $userType = $this->getUserType();
        return view('backend.user.twitter.list', compact('getList', 'title', 'userType'));
      }else{
        return redirect('/dashboard')->with('error', $tStatus['value']);
      }

    }
    public function blacklist()
    {
      $tStatus = $this->twitterAuthId();
      if($tStatus['type'] == 'success'){
        $tAuthId = $tStatus['value'];
        $getList = TwitterFollowersId::getBlackListSelectTwitterId($tAuthId);
        $title = 'blacklist';
        $userType = $this->getUserType();
        return view('backend.user.twitter.list', compact('getList', 'title', 'userType'));
      }else{
        return redirect('/dashboard')->with('error', $tStatus['value']);
      }

    }

    public function followingMsg()
    {
      $tStatus = $this->twitterAuthId();
      if($tStatus['type'] == 'success'){
        $getMsg = UserFollowingMsg::checkExistsUserMsg(Auth::user()->id);
        $userType = $this->getUserType();
        return view('backend.user.twitter.user-following-msg', compact('getMsg', 'userType'));
      }else{
        return redirect('/dashboard')->with('error', $tStatus['value']);
      }
    }

    public function followingMsgSetup(Request $request)
    {
      $input = $request->all();
      try {
        $input['fk_user_id'] = Auth::user()->id;

        $getMsg = UserFollowingMsg::checkExistsUserMsg($input['fk_user_id']);
        if(count($getMsg) > 0){
          $getMsg = UserFollowingMsg::findOrFail($getMsg->id);
          $getMsg->update($input);
        }else{
          UserFollowingMsg::create($input);
        }
        return redirect()->back()->with('success', 'Successfully setup message');
      } catch (\Exception $e) {
        $bug = $e->errorInfo[1];
        $bug1 = $e->errorInfo[2];
        return redirect()->back()->with('error', $bug1);
      }
    }
    public function plans()
    {
      $getPlans = Plans::where('status',1)->orderBy('id','asc')->get();
      return view('backend.user.twitter.plans', compact('getPlans'));
    }

    public function premium($typeName, $packageName, $cat)
    {
      $getPlan = Plans::checkExistsPlanNameWise($packageName);
      if(count($getPlan) > 0){
        return view('backend.user.twitter.payments', compact('getPlan', 'cat'));    
      }else{
        return redirect('/')->with('error', 'Something error, please try again');
      }
    }

    public function checkSync()
    {
      $results['status'] = 'error'; 
      $twitterAuth = $this->twitterAuthId();
      if($twitterAuth['type'] == 'success'){
        $tId = $twitterAuth['value'];
        $checkPre = $this->premiumCheck();
        if($checkPre == true){
          $sync = 240;
        }else{
          $sync = 720;
        }

        $getSidebar = TwitterSidebar::getCheckThisAccountExist($tId);
        $currentTime = Carbon::now();
        $diff = $currentTime->diffInMinutes($getSidebar->created_at);
        $diffTime = $sync - $diff;
        if($diff > $sync){
          $results['status'] = 'success';
          $results['msg'] = 'Heads up! You can update your data now, please click to Yes!';
          return $results;
        }
        $results['msg'] = 'Oppss! You are update your data after then '.$diffTime.' minute.';
      }
      if($twitterAuth['value'] == 'please login again'){
        $results['msg'] = 'Oppss! You are not logged in.';
      }
      return $results;
    }
    
}
