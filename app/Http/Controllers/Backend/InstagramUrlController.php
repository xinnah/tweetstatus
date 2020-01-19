<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class InstagramUrlController extends Controller
{
  public function roleWiseFile()
  {
    if(Auth::user()->role->role_name == 'user'){
      return 'backend.user.instagram.';
    }else{
      return 'backend.user.instagram.';
    }
  }

  public function following()
  {
  	return view($this->roleWiseFile().'following');
  }

  public function followers()
  {
  	return view($this->roleWiseFile().'followers');
  }
  public function search()
  {
  	return view($this->roleWiseFile().'search');
  }
}
