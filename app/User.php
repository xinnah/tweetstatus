<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    public $with = ['role'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'first_name','last_name','phone', 'email', 'password','country','city','state','postal_code','address1','address2','fk_role_id','status'
    ];

    public function role() {
        return $this->belongsTo('App\Models\Role','fk_role_id');
    }

    public static function checkExistsUser($data)
    {
        return DB::table('users')
        ->where('email', $data['email'])
        ->where('password', $data['password'])
        ->first();
    }

    public static function checkExistsUserPhone($data)
    {
        return DB::table('users')
        ->where('phone', $data['phone'])
        ->first();
    }
    public static function checkExistsUserEmail($data)
    {
        return DB::table('users')
        ->where('email', $data['email'])
        ->first();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
