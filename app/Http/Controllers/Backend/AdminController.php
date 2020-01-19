<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use Validator;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSuperAdminId = Role::getSuperAdminId();
        if(count($getSuperAdminId) > 0){
            $superAdminId = $getSuperAdminId->id;
        }else{
            $superAdminId = 0;
        }
        $checkUserRoleId = Role::checkUserRoleId();
        if(count($checkUserRoleId) > 0){
            $userId = $checkUserRoleId->id;
        }else{
            $userId = 0;
        }
        $getAdmin = User::where('fk_role_id','!=',$userId)->where('fk_role_id','!=',$superAdminId)->orderBy('id','asc')->paginate(10);
        return view('backend.admin.view', compact('getAdmin'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRole = Role::whereIn('role_name', ['admin', 'service'])->get();
        return view('backend.admin.create', compact('getRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'fk_role_id' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        
        try {
            User::create($input);
            $bug = 0;
            return redirect()->back()->with('success','New Admin Created Successfully.');
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            return redirect()->back()->with('error',$bug1);
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
        $getAdmin = User::findOrFail($id);

        try {
            $getAdmin->delete();

            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Admin deleted Successfully.');
        }elseif($bug == 1451){
            return redirect()->back()->with('error','This Admin Used AnyWhere.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
}
