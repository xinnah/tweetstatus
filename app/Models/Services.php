<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
  protected $table = 'services';
  protected $fillable = ['name', 'status'];

  public function plan_package(){
    return $this->hasMany('App\Models\PlanPackage','fk_service_id');
  }
}
