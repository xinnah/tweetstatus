<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class PlanPackage extends Model
{
	public $with = ['services'];
  protected $table = 'plan_package';
  protected $fillable = ['fk_plan_id', 'fk_service_id','status'];

  public function plans() {
    return $this->belongsTo('App\Models\Plans','fk_plan_id');
  }

  public function services() {
    return $this->belongsTo('App\Models\Services','fk_service_id');
  }

  public static function checkExistPlanPackage($id)
  {
  	return DB::table('plan_package')
  	->where('fk_plan_id', $id)
  	->get();
  }
}
