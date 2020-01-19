<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
//use Instagram;
use MetzWeb\Instagram\Instagram;
use Session;
use App\Models\InstagramUser;
use Auth;
class InstagramAuthController extends Controller
{
	public function instagram(){
		$instagram = new Instagram(array(
			'apiKey'      => '6160443c106341cdbeba01fe65fc617a',
			'apiSecret'   => 'c01a6dd9b71049598c46d875cefb1f9a',
			'apiCallback' => \url('/').'/login/instagram/callback'
		));
		return $instagram;
	}
  public function login()
  {
		$instagram = $this->instagram();
  	$url = $instagram->getLoginUrl();
  	return Redirect::to($url);
  }

  public function callback(Request $request)
  {
  	
  	try {
  		$instagram = $this->instagram();
	  	// grab OAuth callback code
			$code = $_GET['code'];
			$data = $instagram->getOAuthToken($code);

			// set user access token
			$setAccessToken = $instagram->setAccessToken($data->access_token);
			$getAccessToken = $instagram->getAccessToken($data->access_token);

			$getUser = $instagram->getUser();
			//check user id exists
	    $existsUser = InstagramUser::checkExistsUserId($getUser->data->id);
	    if(count($existsUser) > 0){
	      if($existsUser->token == $getAccessToken){
	        $instagramUser = $existsUser;
	      }else{
	        $updateUser = InstagramUser::updateUserTokenInfo($existsUser->id,$getAccessToken);
	        $instagramUser = InstagramUser::findOrFail($existsUser->id);
	      }
	    }else{
	      $insertUserId = InstagramUser::insertUser($getAccessToken,$getUser->data);
	      $instagramUser = InstagramUser::findOrFail($insertUserId);
	    }
			Session::put('instagramInfo', $instagramUser);
      Session::put('instagram_access_token', $getAccessToken);

      return redirect()->back()->with('success', 'Successfully login');
		  
  	} catch (\Exception $e) {
  		return redirect()->back()->with('error', 'Something error, please try again.');
  	}

		
  }
  public function home()
  {
  	if(Session::has('instagramInfo')){
      $instagramInfo = Session::get('instagramInfo');
      if(Auth::user()->role->role_name == 'user'){
        return view('backend.user.instagram.home');
      }else{

        return view('backend.user.instagram.home');
      }
    }else{
      return $this->login();
      
    }
  }
  public function logout()
  {
    Session::forget('instagramInfo');
    Session::forget('instagram_access_token');
    //return redirect('/dashboard');
  	$url = "https://instagram.com/accounts/logout/";
  	return Redirect::to($url);
  	
  	
  }
}
