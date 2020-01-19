<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\TwitterUser;
use App\Models\InstagramUser;
use App\Models\UserPackages;
use Auth;
use Session;
use Twitter;
class ListOfUserController extends Controller
{
  public function twitter()
  {
    $today = date('Y-m-d');
  	$getUser = UserPackages::where('end_date','>=' ,$today)->paginate(10);
    //return $getUser[0]->users;
  	return view('backend.service-admin.twitter_user', compact('getUser'));
  	
  }

  public function instagram()
  {
  	$getUser = InstagramUser::paginate(10);
  	return view('backend.service-admin.instagram_user', compact('getUser'));
  	
  }

  public function twitterAccessUser(Request $request)
  {
    $input = $request->all();
    
    Session::put('oauth_state', 'start');
    Session::put('oauth_request_token', $input['token']);
    Session::put('oauth_request_token_secret', $input['secret']);
    try
    {
      $request_token = [
      'token'  => $input['token'],
      'secret' => $input['secret'],
      ];
      Twitter::reconfig($request_token);
      $token = [
        'oauth_token' => $input['token'],
        'oauth_token_secret' => $input['secret'],
        'twitter_id' => $input['twitter_id'],
        'user_id' => $input['user_id'],
        'screen_name' => $input['screen_name']
      ];
      

      $credentials = Twitter::getCredentials();

      if (is_object($credentials) && !isset($credentials->error))
        {
          $twitterInfo = Twitter::getUsers(['user_id' => $token['twitter_id'], 'format' => 'array']);
          
          //check userid exists
          $existsUserId = TwitterUser::checkExistsUserId($token['twitter_id']);
          
          if(count($existsUserId) > 0){
            if($existsUserId->token == $token['oauth_token'] && $existsUserId->secret == $token['oauth_token_secret']){
            }else{
              $updateUser = TwitterUser::updateUserTokenInfo($existsUserId->twitter_id,$token);
            }
          }else{
            $insertUser = TwitterUser::insertUser($token,$twitterInfo);
          }
          $objectData = (object)$twitterInfo;
          Session::put('twitterInfo', $objectData);
          Session::put('twitter_access_token', $token);
          return redirect('twitter-dashboard');
        }else{
        
        return redirect()->back()->with('error', 'Something wrong, please try again!');
      }
    }
    catch (\Exception $e)
    {
        dd(Twitter::logs());
    }
    
  }
}
