<?php

namespace App\Models;

use App\Models\UserPackageHistory;
use Illuminate\Database\Eloquent\Model;

class UserPackageHistory extends Model
{
  protected $table = 'user_package_history';
  protected $fillable = ['fk_user_id', 'fk_package_id', 'account_id', 'start_date','end_date', 'status'];

  public static function getCheckUserPackageHistory($data)
  {
  	return UserPackageHistory::where('fk_user_id', $data->fk_user_id)
  	->where('fk_package_id', $data->fk_package_id)
  	->where('account_id', $data->account_id)
  	->whereDate('start_date', $data->start_date)
  	->whereDate('end_date', $data->end_date)
  	->first();
  }
  public function plan_package(){
    return $this->belongsTo('App\Models\Plans','fk_package_id', 'id');
  }
  public function users(){
    return $this->belongsTo('App\User','fk_user_id', 'id');
  }
 

  public static function checkExistPackageInInvoiceWise($data)
  {
    return UserPackageHistory::where('id', $data['id'])
    ->whereDate('start_date', $data['date'])
    ->first();
  }
}
