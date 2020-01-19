<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\PlanPackage;
use App\Models\Services;
use App\Models\FAQ;
class HomeController extends Controller
{
    
    public function index()
    {
        $getPlans = Plans::where('status',1)->orderBy('id','asc')->get();
        return view('index');
    }

    public function plan()
    {
        $getPlans = Plans::where('status',1)->orderBy('id','asc')->get();
        $getFaq = FAQ::where('status',1)->orderBy('id','asc')->get();
        return view('plan', compact('getPlans', 'getFaq'));
    }
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
}
