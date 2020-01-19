<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Plans;
class Plans extends Model
{
	public $with = ['plan_package'];
  protected $table = 'plans';
  protected $fillable = ['name', 'plan_type','description','monthly_price','status', 'plan_category', 'tag_limit', 'following', 'unfollowing', 'mute', 'block'];

  public function plan_package(){
    return $this->hasMany('App\Models\PlanPackage','fk_plan_id');
  }

  public static function checkExistsPlanNameWise($name)
  {
  	return Plans::where('name', $name)->first();
  }

  public static function checkFreePlaneLimitation()
  {
    return Plans::where('plan_category', 1)->first();
  }
}
