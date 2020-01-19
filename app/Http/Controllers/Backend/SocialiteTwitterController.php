<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Session;
use Twitter;
class SocialiteTwitterController extends Controller
{
    
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $twitterInfo = Socialite::driver('twitter')->user();
        \Session::put('twitterInfo',$twitterInfo);
        return redirect('/twitter-dashboard');
    }

    
}
