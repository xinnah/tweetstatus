@extends('layouts.app')
@section('title', 'Plan')
@section('content')
  <div class="tweet-mainpage">
  	<section class="tweet-section tweet-plans">
      <div class="container">
        <div class="row">
            
          <div class="col-md-12">
            <div class="heading">
                <h1 class="title">
                    Pick the plan that's right for you
                </h1>
                <p>Design For Automatic Management</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="plans">
              
            	@foreach($getPlans as $plan)
              <div class="col-md-3">
                <div class="row">
                  <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title uppercase"> {{$plan->name}} </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12">
                            <div class="row">
                              
                                <h2 class="description">
                                    <sup>$</sup>{{$plan->monthly_price}}<sub class="h5">/mo</sub>
                                </h2>
                                <!-- <p class="description">{{$plan->description}}</p> -->
                            </div>
                        </div>
                        <div class="plans-desc capitalize">
                        	<p>{{ $plan->following }} follow</p>
                          <p>{{ $plan->unfollowing }} Unfollow</p>
                          <p>{{ $plan->block }} Block</p>
                          <p>{{ $plan->mute }} Mute</p>
                          <p>@if($plan->plan_category == 1) 0 @else unlimited @endif Whitelist/Blacklist</p>
                          <p>Ads @if($plan->plan_category == 1) Yes @else No @endif </p>
                          <p>Sync Interval @if($plan->plan_category == 1) 12 Hours @else 4 Hours @endif </p>
                          <p>@if($plan->plan_category == 1) Basic Support @else Premium Support @endif </p>
                        </div>
                        <div class="my-md-gutter"></div>
                        @if($plan->plan_category == 1)
                        <a href='{{URL::to("/register")}}' ><button type='button' class='btn btn-reverse'>Free</button></a>
                        @else
                        <a href='{{URL::to("/premium/twitter/$plan->name/m")}}' ><button type='button' class='btn btn-reverse'>Get this plan</button></a>
                        @endif
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
                                                  
	          </div>
	          <div class="my-md-gutter"></div>
          </div>

        </div>
        <div class="row">
          <div class="col-xs-12 text-center">
              <h3>Try Before You Buy | No credit Card Needed | Get More Traffic From Twitter </h3>
              
          </div>
        </div>
      </div>
    </section>
      <!-- <section class="tweet-section tweet-business">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="well">
                          <h3 class="title">Need a bigger plan?</h3>
                          <p>If you need to manage more than 5 Twitter accounts, we can do that too. Join the large list of digital marketing agencies across the world that use Tweetstatus to manage <span class="font-regular">up to 100 clients</span> each from a single Tweetstatus dashboard. We believe in growing with you and make sure we do whatever it takes to help you grow your clients. <a href="#" class="font-regular">Contact us</a> today and get discounted pricing while you grow your clients' businesses.</p>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="heading">
                        <h3 class="title">Join over 40,000 businesses that trust Tweetstatus</h3>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel">
                          <h4 class="panel-header">Start Promoting Your Business NOW</h4>
                          <p>Tweetstatus helps you spread your word and expose your brand to potential customers. You can setup a promotion to automatically Like and ReTweet Tweets by these customers or even follow them. When you do so, they get a notification from Twitter about this engagement and come to check out your brand.</p>
                      </div>
                      <div class="panel">
                          <h4 class="panel-header">Engage People Around You or Globally</h4>
                          <p>You can select your area from the map and then select a radius around it; we will only auto Favorite Tweets that originate from those areas. Alternatively, we can engage people across the world.</p>
                      </div>
                      <div class="panel">
                          <h4 class="panel-header">Remove Your Footprints</h4>
                          <p>With Tweetstatus, you can automatically unlike the Tweets you liked and unfollow the people you followed after some time.</p>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="panel">
                          <h4 class="panel-header">Influence the Influencers in Your Industry</h4>
                          <p>We let you find and engage people with influence based on their Klout score, follower to following ratio and many other parameters.</p>
                      </div>
                      <div class="panel">
                          <h4 class="panel-header">Select Tweets Based on Sentiment</h4>
                          <p>Let us assume you only want to engage with people who are excited about something. For instance, if you are a dance club owner you may want to engage with someone who Tweets "It's Friday and I love it". Tweetstatus can find the sentiment of the Tweet and take action accordingly.</p>
                      </div>
                      <div class="panel">
                          <h4 class="panel-header">Got a List to Engage? We Can Handle That</h4>
                          <p>You can set your promotion to auto Favorite and auto ReTweet Tweets that mention your company's Twitter handle or Tweets written as a reply to you. You can also follow someone's followers. </p>
                      </div>                      
                  </div>
                  <div class="col-md-12">
                      <p>*Please note that there are no guarantees on number of followers. However, these are REAL numbers from our existing users.</p>
                  </div>
              </div>
          </div>
      </section> -->
      <section class="tweet-three-border">
          <div class="border-tweet"></div>
          <div class="border-tweet"></div>
          <div class="border-tweet"></div>
      </section>
      <section class="tweet-section tweet-right-plan">
          <div class="container">
              <div class="row">
                  <div class="col-md-7 col-sm-6">
                      <div class="trybuy">
                          <h3 class="title">CHOOSING THE RIGHT PLAN IS EASY</h3>
                          <p>A Tweetstatus promotion is a marketing campaign that allows you to target potential leads from Twitter in a particular niche. You just need to specify which keywords you want us to search for and what kind of people you want to engage with.</p>
                      </div>
                  </div>
                  <div class="col-md-5 col-sm-6 text-center">
                      <a href="{{URL::to('/register')}}" class="btn btn-default ">Start promoting - It's Free!</a>
                  </div>
              </div>
          </div>
      </section>
      @if(count($getFaq) > 0)
      <section class="tweet-three-border">
          <div class="border-tweet"></div>
          <div class="border-tweet"></div>
          <div class="border-tweet"></div>
      </section>
      <section class="faq_section">
        <div class="container">
          <div class="heading">
            <h1 class="title text-center">Frequently asked questions.</h1>
          </div>
          <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              @foreach($getFaq as $faq)
              <div class="panel panel-default no_padding">
                <div class="panel-heading" role="tab" id="faq{{$faq->id}}">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                          <i class="more-less glyphicon glyphicon-plus"></i>
                          {{$faq->headline}}
                      </a>
                    </h4>
                </div>
                <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq{{$faq->id}}">
                    <div class="panel-body">
                          <?php echo $faq->description; ?>
                    </div>
                </div>
              </div>
              @endforeach
          </div><!-- panel-group -->
          </div>
        </div>
      </section>
      @endif
    </div>

@push('js')
<script>
  function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
@endpush

@endsection