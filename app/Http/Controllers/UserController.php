<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use Validator;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        FAQ::findOrFail(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userRole()
    {
        $getRoleId = Role::select('id')->where('role_name','user')->first();
        if(count($getRoleId) > 0){
            return $getRoleId->id;
        }else{
            $data = [
                'role_name' => 'user',
                'status' => 1
            ];
            return Role::createRole($data);
        }
    }
    public function store(Request $request)
    {

        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['fk_role_id'] = $this->userRole();
        
        try {
            $userId = User::create($input)->id;
            \Auth::loginUsingId($userId);
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Created Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userLogin(Request $request)
    {
        $data['status'] = 'error';
        $input = $request->all();
        
        
        try {
            $checkUser = User::checkExistsUserEmail($input);
            if(count($checkUser) > 0){
                if(!Hash::check($input['pass'],$checkUser->password)){
                    $data['result'] = 'Password does not match';
                }else{
                    $getUser = User::findOrFail($checkUser->id);
                    \Auth::loginUsingId($getUser->id);
                    $data['status'] = 'success';
                    $data['result'] = 'Successfully login';
                }
            }else{
                $data['result'] = 'This user does not exist';
            }
            return $data;
        } catch (\Exception $e) {
            $data['result'] = 'Something wrong, please try again.';
            return $data;
        }
    }
    public function userSignup(Request $request)
    {
        $data['status'] = 'error';
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['fk_role_id'] = $this->userRole();
        try {
            $checkUserEmail = User::checkExistsUserEmail($input);
            $checkUserPhone = User::checkExistsUserPhone($input);
            if(count($checkUserEmail) > 0){
                $data['result'] = 'This email already exist';
            }elseif(count($checkUserPhone) > 0){
                $data['result'] = 'This phone number already exist';
            }else{
                $userId = User::create($input)->id;
                \Auth::loginUsingId($userId);
                $data['status'] = 'success';
                $data['result'] = 'User create Successfully';
            }
            return $data;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            $data['result'] = 'Something wrong, please try again.'.$bug1;
            return $data;
        }
    }
}
