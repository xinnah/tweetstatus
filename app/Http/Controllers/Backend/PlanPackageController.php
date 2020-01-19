<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plans;
use App\Models\PlanPackage;
use App\Models\Services;
use Validator;
use DB;
class PlanPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getPlan = Plans::orderBy('id','asc')->paginate(10);
        return view('backend.plan-package.list', compact('getPlan')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.plan-package.create');
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
            'name'          => 'required',
            'tag_limit'     => 'required',
            'plan_category' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['following'] = preg_replace('/\s+/', ' ',$input['following']);
        $input['unfollowing'] = preg_replace('/\s+/', ' ',$input['unfollowing']);
        $input['mute'] = preg_replace('/\s+/', ' ',$input['mute']);
        $input['block'] = preg_replace('/\s+/', ' ',$input['block']);
        try {
            $id = Plans::create($input)->id;
            
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect("plan-package")->with('success','New Plan Created Successfully.');
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
        $data = array();
        $data['getPlan'] = Plans::findOrFail($id);
        $data['getPackage'] = PlanPackage::where('fk_plan_id', $id)->get();
        if(count($data['getPlan']) > 0){
            return view('backend.plan-package.view', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getPlan = Plans::findOrFail($id);
        return view('backend.plan-package.update', compact('getPlan'));
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
        $getPlan = Plans::findOrFail($id);
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'tag_limit'     => 'required',
            'plan_category' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['following'] = preg_replace('/\s+/', ' ',$input['following']);
        $input['unfollowing'] = preg_replace('/\s+/', ' ',$input['unfollowing']);
        $input['mute'] = preg_replace('/\s+/', ' ',$input['mute']);
        $input['block'] = preg_replace('/\s+/', ' ',$input['block']);
        try {
            $getPlan->update($input);
            
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Update Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getPlan = Plans::findOrFail($id);

        try {
            // $planPackage = PlanPackage::checkExistPlanPackage($id);
            // $countPlanPackage = count($planPackage);
            // if($countPlanPackage > 0){
            //     for ($p=0; $p < $countPlanPackage; $p++) { 
            //         $getPlanPackage = PlanPackage::findOrFail($planPackage[$p]->id);
            //         $getPlanPackage->delete();
            //     }
            // }
            $getPlan->delete();
            $bug = 0;
        } catch (\Exception $e) {
           $bug = $e->errorInfo[1];
           $bug1 = $e->errorInfo[2]; 
        }

        if($bug == 0){
            
            return redirect()->back()->with('success',' Remove Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }

    }

    public function planSet(Request $request)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'search_text' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        //return $input;
        try {
            $existService = Services::where('name', $input['search_text'])->first();
            if(count($existService) > 0){
                $input['fk_service_id'] = $existService->id;
            }else{
                $id = Services::create(['name' => $input['search_text']])->id;
                $input['fk_service_id'] = $id;
            }

            
            $id = PlanPackage::create($input)->id;
            
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success',' Created Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    public function planSetUpdate(Request $request, $id)
    {

        $getPlanPackage = PlanPackage::findOrFail($id);

       
        try {
            $getPlanPackage->delete();
            
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success',' Remove Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
}
