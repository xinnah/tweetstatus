<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use App\Mail\PasswordReset;
use App\Models\UserPackageHistory;
use Mail;
class ProfileController extends Controller
{
  public function index()
  {
  	$getUser = Auth::user();
    
  	return view('backend.profile.view', compact('getUser'));
  }

  public function settings()
  {
    $getUser = Auth::user();
    $getPackageHistory = UserPackageHistory::where('fk_user_id', $getUser->id)->get();
    $premium = $this->premiumCheck();
    return view('backend.profile.settings', compact('getUser', 'getPackageHistory', 'premium'));
  }

  public function edit()
  {
  	$getUser = Auth::user();
    
  	return view('backend.profile.edit', compact('getUser'));
  }
  public function cPass()
  {
   
  	return view('backend.profile.change_password');
  }
  public function update(Request $request)
  {
  	$getUser = Auth::user();
  	$input = $request->all();
  	try {
  		$getUser->update($input);
  		return redirect()->back()->with(['success' => 'Profile update successfully', 'status' => 1]);
  	} catch (\Exception $e) {
  		$bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      return redirect()->back()->with(['error' => $bug1, 'status' => 1]);
  	}
  }
  public function updatePass(Request $request)
  {
  	$getUser = Auth::user();
  	$input = $request->all();

  	try {
  		if(!Hash::check($input['old_password'],$getUser->password)){
    		return redirect()->back()->with(['error' => 'The specified password does not match the database password', 'status' => 2]);
      }elseif ($input['password'] != $input['password_confirmation']) {
      	return redirect()->back()->with('error','Confirm Passwords Do Not Match');
      }else{
        $data['password'] = bcrypt($input['password']);
				$getUser->update($data);
        return redirect()->back()->with(['success' => 'Password change successfully', 'status' => 2]);
      }
  	} catch (\Exception $e) {
  		$bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      return redirect()->back()->with(['error' => $bug1, 'status' => 2]);
  	}
  }

  
}
