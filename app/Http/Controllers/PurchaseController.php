<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Plans;
use App\Models\UserPackageHistory;
use App\Models\UserPackages;
use App\User;
use Illuminate\Http\Request;
use Validator;

class PurchaseController extends Controller
{
  public function checkUserExistService($data)
  {
    $userCheck = UserPackages::checkExistsPackage($data);
    if(count($userCheck) > 0){
      $checkEndDate = $userCheck->end_date;
      $today = date('Y-m-d');
      if($checkEndDate >= $today){
        return 'yes';
      }
      return 'no';
    }
    return "no";
  }
  public function checkUserPurchase(Request $request)
  {
  	$input = $request->all();
  	return $this->checkUserExistService($input);
  	
  }

  public function purchase(Request $request)
  {
  	$data['status'] = 'error';
  	$input = $request->all();
  	$input['start_date'] = date('Y-m-d');
  	$input['end_date'] = date('Y-m-d', strtotime('+1 month'));
    $input['status'] = 0;
  	try {
  		$userCheck = UserPackages::checkExistsPackage($input);
      
  		if(count($userCheck) > 0){
  			$getPackage = UserPackages::findOrFail($userCheck->id);
  			$getPackage->update($input);
  		}else{
  			UserPackages::create($input);
  		}
      UserPackageHistory::create($input);
  		$data['status'] = 'success';
  		$data['result'] = 'Successfully purchase';
      return $data;
  	} catch (\Exception $e) {
  		$bug = $e->errorInfo[1];
      $bug1 = $e->errorInfo[2];
      $data['result'] = $bug1;
      return $data;
  	}
  }
  
}
