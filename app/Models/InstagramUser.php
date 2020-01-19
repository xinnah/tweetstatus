<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class InstagramUser extends Model
{
  protected $table = 'instagram_user';
  protected $fillable = ['instagram_id', 'token', 'username','full_name', 'profile_picture','bio','website','follows','followed_by','media','is_business','logged'];

  public static function checkExistsUserId($id)
  {
    return DB::table('instagram_user')
    ->where('instagram_id', $id)
    ->first();
  }

  public static function insertUser($token, $data)
  {
  	return DB::table('instagram_user')
  	->insertGetId([
  		'instagram_id'    => $data->id,
  		'token'           => $token,
  		'username'        => $data->username,
  		'full_name'       => $data->full_name,
  		'profile_picture' => $data->profile_picture,
  		'bio'             => $data->bio,
  		'website'         => $data->website,
  		'follows'         => $data->counts->follows,
  		'followed_by'     => $data->counts->followed_by,
  		'media'           => $data->counts->media,
  		'is_business'     => $data->is_business,
      'logged'          => 0,
  		'created_at'      => date('Y-m-d h:i:s') 
  	]);
  }

  public static function updateUserTokenInfo($id, $token)
  {
    return DB::table('instagram_user')
    ->where('instagram_id',$id)
    ->update([
      'token'  => $token
    ]);
  }
}
