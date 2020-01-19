<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\TwitterTweets;
use App\Models\UserPackages;
use Session;
use Twitter;
use Validator;
use DB;
use Auth;
use Carbon\Carbon;
class TwitterTweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getTId()
    {
        $result['type'] = 'error';
        if(Session::has('twitterInfo')){
            $result['type'] = 'success';
            $twitterInfo = Session::get('twitterInfo');
            $result['value'] = $twitterInfo['id_str'];
        }else{
            $result['value'] = 'please again twitter login';
        }
        return $result;
    }
    public function index()
    {
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $getTId = $this->getTId();
      if($getTId['type'] == 'success'){
          $tId = $getTId['value'];
      }else{
          return redirect()->back()->with('error', $getTId['value']);
      }
      $getTweets = TwitterTweets::where('fk_twitter_id', $tId)->paginate(10);
      return view('backend.user.twitter.tweets.index', compact('getTweets'));
    }
    public function schedule()
    {
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $getTId = $this->getTId();
      if($getTId['type'] == 'success'){
          $tId = $getTId['value'];
      }else{
          return redirect()->back()->with('error', $getTId['value']);
      }
      $getTweets = TwitterTweets::where('fk_twitter_id', $tId)->get();
      $totalTweets = count($getTweets);
      $getResults = array();
      for ($i=0; $i < $totalTweets; $i++) { 
        $time = Carbon::parse($getTweets[$i]->time)->format('h:m A');
        $row['title'] = $time.' '.$getTweets[$i]->content;
        $row['content'] = $getTweets[$i]->content;
        $row['content'] = $getTweets[$i]->content;
        $row['start'] = $getTweets[$i]->date;
        $row['time'] = $getTweets[$i]->time;
        //$row['file'] = $getTweets[$i]->file;
        $row['id'] = $getTweets[$i]->id;
        if($getTweets[$i]->color != null){  
        $row['cssClass'] = $getTweets[$i]->color;
        }
        $getResults[] = $row;
      }
      return view('backend.user.twitter.tweets.schedule', compact('getResults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $title = 'Twitter tweet';
      return view('backend.user.twitter.tweets.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //echo "tweet";
      $data['status'] = 'error'; 
      if($this->checkOAuth() != 'success'){
        $data['msg'] = 'please again twitter login';
        return $data;
      }
      $input = $request->all();

      $getTId = $this->getTId();
      if($getTId['type'] == 'success'){
          $input['fk_twitter_id'] = $getTId['value'];
      }else{
        $data['msg'] = $getTId['value'];
        return $data;
      }
      $datetimeString = Carbon::parse($input['datetime'])->toDateTimeString();
      $input['date'] = Carbon::parse($input['datetime'])->format('Y-m-d');
      $input['time'] = Carbon::parse($input['datetime'])->format('H:i');
      
      try {
        if($input['date'] < $input['currentDate']){
            $data['msg'] = 'Your select date is over';
            return $data;
        }elseif($input['date'] == $input['currentDate']){
            if($input['time'] == $input['currentTime']){
                Twitter::postTweet(['status' => $input['content'], 'format' => 'json']);
                $data['msg'] = 'Successfully tweet sent';
            }elseif($input['time'] < $input['currentTime']){
              $data['msg'] = 'Your select time is over';
              return $data;
            }
        }
        $data['status'] = 'success';
        Session::flash('success', 'Successfully upload schedule tweet');
        TwitterTweets::create($input);
        $data['msg'] = 'Successfully create schedule tweet';
        return $data;
      } catch (\Exception $e) {
        $bug = $e->errorInfo[1];
        $bug1 = $e->errorInfo[2];
        $data['msg'] = $bug1;
        return $data;
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
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $getTweet = TwitterTweets::findOrFail($id);
      $title = 'twitter tweet edit';
      if(count($getTweet) > 0){
          return view('backend.user.twitter.tweets.edit', compact('getTweet', 'title'));
      }
      return $getTweet;
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
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $getTweet = TwitterTweets::findOrFail($id);
      if($this->checkOAuth() != 'success'){
          return redirect()->back()->with('error', 'please again twitter login');
      }
      /*validator all field*/
      $validator = Validator::make($request->all(),[
          'date' => 'required',
          'time' => 'required',
          'content' => 'required'
      ]);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
      }
      $input = $request->all();

      $getTId = $this->getTId();
      if($getTId['type'] == 'success'){
          $input['fk_twitter_id'] = $getTId['value'];
      }else{
          return redirect('')->back()->with('error', $getTId['value']);
      }

      try {
          if($input['date'] < $input['currentDate']){
              return redirect()->back()->with('error', 'Your select date is over');
          }elseif($input['date'] == $input['currentDate']){
              if($input['time'] == $input['currentTime']){
                  Twitter::postTweet(['status' => $input['content'], 'format' => 'json']);
                  $getTweet->delete();
                  return redirect('twitter-tweets')->with('success', 'Successfully tweet sent');
              }elseif($input['time'] < $input['currentTime']){
                  return redirect()->back()->with('error', 'Your select time is over');
              }
          }
          //update tweet
          
          $getTweet->update($input);
          return redirect('/twitter-schedule-tweets')->with('success', 'Successfully update schedule tweet');

      } catch (\Exception $e) {
          $bug = $e->errorInfo[1];
          $bug1 = $e->errorInfo[2];
          return redirect()->back()->with('error', $bug1);
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
      if($this->premiumCheck() == false){
        return redirect()->back()->with('error', 'Free accounts cannot access tweet feature.');
      }
      $getTweet = TwitterTweets::findOrFail($id);
      $getTweet->delete();
      Session::flash('success', 'Successfully delete tweet');
      return redirect('/twitter-schedule-tweets');
    }
}
