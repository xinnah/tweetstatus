<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twitter;
use App\User;
use App\Models\TwitterFollowersId;
use App\Models\TwitterFollowingId;
use App\Models\UserPackages;
use Auth;
use Session;
class TwitterWhiteBackListController extends Controller
{
	
  public function postBacklist(Request $request)
  {
  	$result['type'] = 'error';
  	$input = $request->all();
  	if(Session::has('twitterInfo')){
      $twitterInfo = Session::get('twitterInfo');
  		$input['fk_twitter_id'] = $twitterInfo->id;
  	}else{
  		$result['value'] = 'Please login again';
  		return $result;
  	}
    if($this->premiumCheck() == false){
      $result['value'] = 'Free accounts cannot use Backlist feature.';
      return $result;
    }
  	try {
  		$result['type'] = 'success';
  		//0 = add backlist , 1 = remove backlist
  		if($input['type'] == 0){
        $getData = TwitterFollowersId::checkExistsId($input);
        if(count($getData) > 0){
          if($getData->backlist == 1){
            $result['value'] = 'Already added backlist this user';
          }else{
            $data = [
              'backlist' => 1
            ];
            $getData = TwitterFollowersId::findOrFail($getData->id);
            $getData->update($data);
            $result['value'] = 'Successfully add backlist this user';
          }
        }else{
          $result['value'] = 'Something wrong, Please login again';
        }
        
      }elseif($input['type'] == 1){
        $getData = TwitterFollowersId::checkExistsId($input);
        if(count($getData) > 0){
        	if($getData->backlist == 0){
        		$result['value'] = 'Already remove backlist this user';
        	}else{
        		$data = [
	        		'backlist' => 0
	        	];
	        	$getData = TwitterFollowersId::findOrFail($getData->id);
	        	$getData->update($data);
	        	$result['value'] = 'Successfully remove backlist this user';
        	}
        }else{
        	$result['value'] = 'Something wrong, Please login again';
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

  public function postWhitelist(Request $request)
  {
  	$result['type'] = 'error';
  	$input = $request->all();
  	if(Session::has('twitterInfo')){
      $twitterInfo = Session::get('twitterInfo');
  		$input['fk_twitter_id'] = $twitterInfo->id;
  	}else{
  		$result['value'] = 'Please login again';
  		return $result;
  	}
    if($this->premiumCheck() == false){
      $result['value'] = 'Free accounts cannot use Whitelist feature.';
      return $result;
    }
  	try {
  		$result['type'] = 'success';
  		//0 = add whitelist , 1 = remove whitelist
  		if($input['type'] == 0){
        $getData = TwitterFollowingId::checkExistsId($input);
        if(count($getData) > 0){
          if($getData->whitelist == 1){
            $result['value'] = 'Already added whitelist this user';
          }else{
            $data = [
              'whitelist' => 1
            ];
            $getData = TwitterFollowingId::findOrFail($getData->id);
            $getData->update($data);
            $result['value'] = 'Successfully add whitelist this user';
          }
        }else{
          $result['value'] = 'Something wrong, Please login again';
        }
        
      }elseif($input['type'] == 1){
        $getData = TwitterFollowingId::checkExistsId($input);
        if(count($getData) > 0){
        	if($getData->whitelist == 0){
        		$result['value'] = 'Already remove whitelist this user';
        	}else{
        		$data = [
	        		'whitelist' => 0
	        	];
	        	$getData = TwitterFollowingId::findOrFail($getData->id);
	        	$getData->update($data);
	        	$result['value'] = 'Successfully remove whitelist this user';
        	}
        }else{
        	$result['value'] = 'Something wrong, Please login again';
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

  
}
