<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserPackages;
use Session;
use Twitter;
use Auth;
class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function checkUserExistService($data)
  {
    $userCheck = UserPackages::checkExistsPackage($data);
    if(count($userCheck) > 0){
      $checkEndDate = $userCheck->end_date;
      $today = date('Y-m-d');
      if($checkEndDate >= $today){
        $result['type'] = 'yes';
        $result['plan_category'] = $userCheck->Plans->plan_category;
        $result['tag_limit'] = $userCheck->Plans->tag_limit;
        $result['status'] = $userCheck->status;
        $result['id'] = $userCheck->id;
        $result['account_id'] = $userCheck->account_id;
        return $result;
      }
    }
    $result['type'] = 'no';
    return $result;
  }
  public function roleWiseFile()
  {
    if(Auth::user()->role->role_name == 'user'){
      $input['fk_user_id'] = Auth::user()->id;
      $userCheck = UserPackages::checkExistsPackage($input);
      if(count($userCheck) > 0){
        $checkEndDate = $userCheck->end_date;
        $today = date('Y-m-d');
        if($checkEndDate >= $today){
          $twitterInfo = Session::get('twitterInfo');
          if($twitterInfo['id_str'] == $userCheck->account_id){
            return 'backend.user.twitter.';
          }
        }
      }
      return 'backend.user.twitter.free.';
    }else{
      return 'backend.user.twitter.';
    }
  }
  public function premiumCheck()
  {
    if(Auth::user()->role->role_name == 'user'){
      $input['fk_user_id'] = Auth::user()->id;
      $userCheck = UserPackages::checkExistsPackage($input);
      if(count($userCheck) > 0){
        $checkEndDate = $userCheck->end_date;
        $today = date('Y-m-d');
        if($checkEndDate >= $today){
          $twitterInfo = Session::get('twitterInfo');
          if($twitterInfo['id_str'] == $userCheck->account_id){
            return true;
          }
        }
      }
      return false;
    }else{
      return true;
    }
    
  }
  public function getUserType()
  {
    if(Auth::user()->role->role_name == 'user'){
      $input['fk_user_id'] = Auth::user()->id;
      $userCheck = UserPackages::checkExistsPackage($input);
      if(count($userCheck) > 0){
        $checkEndDate = $userCheck->end_date;
        $today = date('Y-m-d');
        if($checkEndDate >= $today){
          $twitterInfo = Session::get('twitterInfo');
          if($twitterInfo['id_str'] == $userCheck->account_id){
            return 'premium';
          }
        }
      }
      return 'free';
    }else{
      return 'premium';
    }
    
  }
  public function getTwitterInfo($tId)
  {
    $data['status'] = 'error';
    try {
      $data['status'] = 'success';
      $data['value'] = Twitter::getUsers(['user_id' => $tId, 'format' => 'array']);
      return $data;
    } catch (\Exception $e) {
      $bug1 = $e->errorInfo[2];
      $data['value'] = $bug1;
      return $data;
    }
    
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
}
