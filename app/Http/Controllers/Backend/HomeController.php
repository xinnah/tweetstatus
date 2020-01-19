<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\Plans;
use App\Models\UserPackages;
use App\Models\UserPackageHistory;

use App\Models\TwitterUser;
use App\User;
class HomeController extends Controller
{
	public function __construct()
    {
      $this->middleware('auth');
    }
  public function index()
  {
    $data = [];
    $data['getPlans'] = Plans::where('status',1)->orderBy('id','asc')->get();
    $data['totalTwitterUser'] = TwitterUser::count();
    $data['activeTwitterUser'] = UserPackages::where('end_date' ,'>', date("Y-m-d"))->count();
    $data['totalUser'] = User::count();
  	if(Auth::user()->role->role_name == 'user'){
      return view('backend.user.welcome', $data);
    }elseif(Auth::user()->role->role_name == 'service'){
    	return view('backend.service-admin.welcome', $data);
  	}else{
  		$data['plans'] = Plans::get();
      $data['userPackages'] = UserPackages::get();
      return view('backend.welcome', $data);
  	}
  }

  public function userInvoice(Request $request)
  {
    $input = $request->all();
    $invoiceFormat= explode('_',$input['id']);
    if(count($invoiceFormat) != 2){
      return redirect()->back()->with('error', 'Something wrong');
    }
    $invoice['date'] = $invoiceFormat[0];
    $invoice['id'] = $invoiceFormat[1];
    $getPackage = UserPackageHistory::checkExistPackageInInvoiceWise($invoice);
    if(count($getPackage) > 0){
      return view('backend.profile.invoice', compact('getPackage'));
    }
    return redirect()->back()->with('error', 'Something wrong');
  }

}
