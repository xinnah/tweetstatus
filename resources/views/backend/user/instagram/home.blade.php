@extends('backend.layouts.app')
@push('css')
	<style>
		.avater-design{border-radius: 50%;}
		.h100{height: 100%;}
		.w100{width: 100%;}
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
		if(Session::has('instagramInfo')){
			$instagramInfo = Session::get('instagramInfo');
			$name = $instagramInfo->username;
			$followers = $instagramInfo->follows;
			$following = $instagramInfo->followed_by;
			$media = $instagramInfo->media;
			$avater = $instagramInfo->profile_picture;
		}else{
			$instagramInfo = [];
			$name = '';
			$followers = '';
			$following =  '';
			$media =  '';
			$avater =  '';
		}

	 ?>
		<!-- begin #content -->
		<div class="content no_padding">
			<div class="alert alert-shadow alert-dismissable ">
	      <div class="notification-info">
          <h2 class="page-header no_margin"><i class="fas fa-home header-icon"></i> instagram dashboard <!-- <a href="{{URL::to('instagram-update')}}" class="btn btn-info btn-sm"><i class="fab fa-instagram"></i> instagram update</a> --></h2>
        </div>
	    </div>
		</div>
		<div id="content" class="content">
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-4 -->
				<div class="col-lg-4 col-md-6">
					<div class="widget widget-stats bg-gradient-purple">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">You Follow</div>
							<div class="stats-number"> {{ $followers }}</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: {{ $followers }}%;"></div>
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
							<div class="stats-title">Followers</div>
							<div class="stats-number">{{ $following }}</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: {{ $following }}%;"></div>
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
							<div class="stats-title">Media</div>
							<div class="stats-number">{{ $media }}</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: {{ $media }}%;"></div>
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
				
				<!-- begin col-4 -->
				<div class="col-lg-4">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h2 class="panel-title">
								Add Post
							</h2>
						</div>
						<div id="visitors-map" class="bg-black" style="height: 279px;">
							<div class="widget widget-stats bg-gradient-black h100">
								<div class="stats-icon stats-icon-lg w100"><i class="fas fa-camera-retro"></i></div>
								
							</div>
						</div>
						
					</div>
				</div>
				<!-- end col-4 -->
				<!-- begin col-4 -->
				<div class="col-lg-4">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h2 class="panel-title">
								Add Story
							</h2>
						</div>
						<div id="visitors-map" class="bg-black" style="height: 279px;">
							<div class="widget widget-stats bg-gradient-black h100">
								<div class="stats-icon stats-icon-lg w100"><i class="fa fa-plus-circle"></i></div>
								
							</div>
						</div>
						
					</div>
				</div>
				<!-- end col-4 -->
				<!-- begin col-4 -->
				<div class="col-lg-4">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h2 class="panel-title">
								Add Album
							</h2>
						</div>
						<div id="visitors-map" class="bg-black" style="height: 279px;">
							<div class="widget widget-stats bg-gradient-black h100">
								<div class="stats-icon stats-icon-lg w100"><i class="fab fa-audible"></i></div>
								
							</div>
						</div>
						
					</div>
				</div>
				<!-- end col-4 -->
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
    <script src="{{asset('public/assets/js/demo/dashboard-v2.min.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
		
	@endpush
@endsection