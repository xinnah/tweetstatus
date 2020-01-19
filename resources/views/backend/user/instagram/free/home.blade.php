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
  <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
@endpush

@section('content')
		<?php 
		if(Session::has('twitterInfo')){
			$twitterInfo = Session::get('twitterInfo');
			$name = $twitterInfo->name;
			$followers_count = $twitterInfo->followers_c;
			$friends_count = $twitterInfo->following_c;
			$statuses_count = $twitterInfo->tweets;
			$avater = $twitterInfo->profile_image;
			$favourites_count = $twitterInfo->likes;
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
		<!-- begin page-header -->
		<div class="content no_padding">

			<div class="alert alert-shadow alert-dismissable ">
	      <div class="notification-info">
          <h2 class="page-header no_margin"><i class="fas fa-home header-icon"></i> Twitter dashboard <a href="{{URL::to('twitter-update')}}" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i> Twitter update</a></h2>
        </div>
	    </div>
		</div>
		<!-- end page-header -->
		<div id="content" class="content">
			@include('backend.user.twitter.free.premium-top-header')
			<!-- begin row -->
			<div class="row">
				<div class="col-sm-10">
					<div class="row">
						<!-- begin col-4 -->
						<div class="col-lg-4 col-md-6">
							<div class="widget widget-stats bg-gradient-purple">
								<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
								<div class="stats-content">
									<div class="stats-title">Followers</div>
									<div class="stats-number"> {{ $followers_count }}</div>
									<div class="stats-progress progress">
										<div class="progress-bar" style="width: {{ $followers_count }}%;"></div>
									</div>
									<!-- <div class="stats-desc">2000 you don't follow</div> -->
								</div>
							</div>
						</div>
						<!-- end col-4 -->
						<!-- begin col-4 -->
						<div class="col-lg-4 col-md-6">
							<div class="widget widget-stats bg-gradient-black">
								<div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
								<div class="stats-content">
									<div class="stats-title">You Follow</div>
									<div class="stats-number">{{ $friends_count }}</div>
									<div class="stats-progress progress">
										<div class="progress-bar" style="width: {{ $friends_count }}%;"></div>
									</div>
									<!-- <div class="stats-desc">B100 don't follow you</div> -->
								</div>
							</div>
						</div>
						<!-- end col-4 -->
						<!-- begin col-4 -->
						<div class="col-lg-4 col-md-6">
							<div class="widget widget-stats bg-gradient-teal">
								<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
								<div class="stats-content">
									<div class="stats-title">Tweets</div>
									<div class="stats-number">{{ $statuses_count }}</div>
									<div class="stats-progress progress">
										<div class="progress-bar" style="width: {{ $statuses_count }}%;"></div>
									</div>
									<!-- <div class="stats-desc">&nbsp;</div> -->
								</div>
							</div>
						</div>
						<!-- end col-4 -->
						
					</div>
					<!-- end row -->
					<!-- begin row -->
					<div class="row">
						<!-- begin col-8 -->
						<div class="col-lg-8">
							<div class="widget-chart with-sidebar inverse-mode">
								<div class="widget-chart-content bg-black">
									<h4 class="chart-title">
										Visitors Analytics
										<small>Where do our visitors come from</small>
									</h4>
									<div id="visitors-line-chart" class="widget-chart-full-width nvd3-inverse-mode" style="height: 260px;"></div>
								</div>
								<div class="widget-chart-sidebar bg-black-darker">
									<div class="chart-number">
										1,225,729
										<small>Total visitors</small>
									</div>
									<div id="visitors-donut-chart" class="nvd3-inverse-mode p-t-10" style="height: 180px"></div>
									<ul class="chart-legend f-s-11">
										<li><i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> 34.0% <span>New Visitors</span></li>
										<li><i class="fa fa-circle fa-fw text-success f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Return Visitors</span></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- end col-8 -->
						<!-- begin col-4 -->
						<div class="col-lg-4">
							<div class="panel panel-inverse" data-sortable-id="index-1">
								<div class="panel-heading">
									<h4 class="panel-title">
										Visitors Origin
									</h4>
								</div>
								<div id="visitors-map" class="bg-black" style="height: 179px;"></div>
								<div class="list-group">
									<a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
										1. United State 
										<span class="badge f-w-500 bg-gradient-teal f-s-10">20.95%</span>
									</a> 
									<a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
										2. India
										<span class="badge f-w-500 bg-gradient-blue f-s-10">16.12%</span>
									</a>
									<a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
										3. Mongolia
										<span class="badge f-w-500 bg-gradient-grey f-s-10">14.99%</span>
									</a>
								</div>
							</div>
						</div>
						<!-- end col-4 -->
					</div>
				</div>
				<div class="col-sm-2">
					@include('backend.user.twitter.free.ads_vertical')
				</div>
			</div>
			
			<!-- end row -->

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
  <script src="{{asset('assets/js/demo/dashboard-v2.min.js')}}"></script>
    
	@endpush
@endsection