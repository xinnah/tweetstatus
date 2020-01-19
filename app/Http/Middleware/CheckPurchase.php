<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserPackages;
use Auth;
class CheckPurchase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()){
            $input['fk_user_id'] = $request->user()->id;
            if($request->user()->role->role_name == 'user'){
                $userCheck = UserPackages::checkExistsPackage($input);
                if(count($userCheck) > 0){
                    $checkEndDate = $userCheck->end_date;
                    $today = date('Y-m-d');
                    if($checkEndDate >= $today && $userCheck->Plans->plan_category == 3){
                        return redirect()->back()->with('error',"You are premium user , so you don't access free version");
                    }
                    return $next($request);
                }
                return $next($request);
            }
            return $next($request);  
        }else{
            return redirect('/dashboard');
        }
        
        
        
    }
}
