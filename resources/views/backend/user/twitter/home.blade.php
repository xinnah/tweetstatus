@extends('backend.layouts.app')
@push('css')
	<style>
		.avater-design{border-radius: 50%;}
	</style>
	
  <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
  <link href="{{asset('public/assets/plugins/jquery-jvectormap/jquery-jvectormap.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/nvd3/build/nv.d3.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/css/hot-topics.css')}}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
 
@endpush
@section('title', 'Twitter dashboard')
@section('content')
	<?php 
	if(Session::has('twitterInfo')){
		$twitterInfo = Session::get('twitterInfo');
		$name = $twitterInfo->name;
		$followers_count = $twitterInfo->followers_count;
		$friends_count = $twitterInfo->friends_count;
		$statuses_count = $twitterInfo->statuses_count;
		$avater = $twitterInfo->profile_image_url;
		$favourites_count = $twitterInfo->favourites_count;
	}else{
		$twitterInfo = [];
		$name = '';
		$followers_count = '';
		$friends_count =  '';
		$statuses_count =  '';
		$avater =  '';
		$favourites_count =  '';
	}

 ?>
		<!-- begin #content -->
		<div class="content no_padding">
			<div class="alert alert-shadow alert-dismissable ">
	      <div class="notification-info">
          <h2 class="page-header no_margin"><i class="fas fa-home header-icon"></i> Dashboard <small><i>homepage of summary and statistics</i></small></h2>
        </div>
	    </div>
		</div>
		<div id="content" class="content">
			
			<div class="col-sm-12">
				<div class="row">
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-gradient-purple">
							<div class="ribbon-wrapper">
                <a href="{{URL::to('/twitter-followers')}}" class="ribbon ribbon-purple ribbon-shadow">View</a>
              </div>
							<div class="stats-icon stats-icon-lg"><i class="fas fa-users"></i></div>
							<div class="stats-content">
								<div class="stats-title uppercase">followers</div>
								<div class="stats-number"> {{ $followers_count }}</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: {{ $tFollowers }}%;"></div>
								</div>
								<div class="stats-desc"><span class="pull-left uppercase">change</span><span class="pull-right">{{$tFollowers}}%</span></div>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-gradient-teal">
							<div class="ribbon-wrapper">
                <a href="{{URL::to('/twitter-following')}}" class="ribbon ribbon-sky ribbon-shadow">View</a>
            	</div>
							<div class="stats-icon stats-icon-lg"><i class="fas fa-user-plus"></i></div>
							<div class="stats-content">
								<div class="stats-title uppercase">following</div>
								<div class="stats-number">{{ $friends_count }}</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: {{ $tFollowing }}%;"></div>
								</div>
								<div class="stats-desc"><span class="pull-left uppercase">change</span><span class="pull-right">{{ $tFollowing }}%</span></div>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-gradient-black">
							<div class="ribbon-wrapper">
                <a href="#" class="ribbon ribbon-inverst ribbon-shadow">View</a>
              </div>
							<div class="stats-icon stats-icon-lg"><i class="fab fa-twitter"></i></div>
							<div class="stats-content">
								<div class="stats-title uppercase">tweets </div>
								<div class="stats-number">{{ $statuses_count }}</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: {{ $statuses_count }}%;"></div>
								</div>
								<div class="stats-desc"><span class="pull-left uppercase">change</span><span class="pull-right">0%</span></div>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-gradient-blue">
							<div class="ribbon-wrapper">
                <a href="#" class="ribbon ribbon-blue ribbon-shadow">View</a>
              </div>
							<div class="stats-icon stats-icon-lg"><i class="fas fa-heart"></i></div>
							<div class="stats-content">
								<div class="stats-title uppercase">likes</div>
								<div class="stats-number">{{$favourites_count}}</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: {{$favourites_count}}%;"></div>
								</div>
								<div class="stats-desc"><span class="pull-left uppercase">change</span><span class="pull-right">0%</span></div>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					
				</div>
				<!-- end row -->
				<!-- begin row -->
				<div class="row">
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-12">
								<daily-report-chart :plan="{{json_encode($planPurchase)}}"></daily-report-chart>
								
							</div>
							<!-- begin col-8 -->
							<div class="col-lg-8">
								
								<div class="user_timeline">
									<div class="panel panel-info ">
									  <div class="panel-heading widget widget-stats no_margin"><h4 class="chart-title uppercase">
												Your timeline
											</h4>
											<div class="stats-icon stats-icon-lg" style="top: 0px !important;"><i class="fab fa-twitter"></i></div>
										</div>
									  <div class="panel-body">
									    <div id="twitter-usertimeline" class="bg-black">
									    	@if(count($getUserTimeline) > 0)
												<twitter-timeline :posts="{{json_encode($getUserTimeline)}}"></twitter-timeline>
												@else
												<div>
													<div class="panel panel-default">
														<h5 class="text-center">No timeline found!</h5>
													</div>
												</div>
												@endif
											</div>
									  </div>
									</div>
								</div>
								
							</div>
							<!-- end col-8 -->
							<!-- begin col-4 -->
							<div class="col-lg-4">
								@if(count($lastMention) > 0)
								<div class="panel panel-success" data-sortable-id="index-1">
									<div class="panel-heading">
										<h2 class="panel-title">
											Latest Mentions Users
										</h2>	
									</div>
									<div class="panel-body">
										<p>Based on last 20 mentions you get.</p>
										<div class="list-group">
											@foreach($lastMention as $mUser)
											<div class="list-group-item list-group-item-default d-flex justify-content-between align-items-center text-ellipsis">
					              <div class="twitter_get_image col-sm-3 no_padding">
					                <img class="" src="{{$mUser['image']}}">
					              </div>
					              <div class="twitter_get_content col-sm-9">
					                <a target="_blank" class="">{{ $mUser['name'] }}</a>
					                <br>
					                <span><a target="_blank">@ {{ $mUser['screen_name'] }}</a></span>
					              </div>
					            </div>
											@endforeach
										</div>
									</div>
								</div>
								@endif
								
							</div>
							<!-- end col-4 -->
						</div>
						<div class="row">
					    <div class="col-sm-12">
					      <!-- begin panel -->
					      <div class="panel panel-inverse">
					        <div class="panel-heading">
					            
					            <h4 class="panel-title">Recent Followers</h4>
					        </div>

					        <div class="panel-body">
					        	@if(count($getFollowerId) > 0)
					          <twitter-get-data :getids="{{json_encode($getFollowerId)}}" :type="{{json_encode('followers')}}"></twitter-get-data>
					          @else
										<div>
											<div class="panel panel-default">
												<h5 class="text-center">No follower found!</h5>
											</div>
										</div>
										@endif
					        </div>
					      </div>
					      <!-- end panel -->
					    </div>
					  </div>
					</div>
					<div class="col-sm-3 no_padding">
						@include('backend.user.twitter.hot-topics')
					</div>
				</div>
			</div>
		</div>
		<!-- end #content -->
	@push('js')

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{asset('public/assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/nvd3/build/nv.d3.js')}}"></script>
    <script src="{{asset('public/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('public/assets/js/demo/dashboard-v2.min.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

	@endpush
@endsection