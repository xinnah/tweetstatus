@extends('backend.layouts.app')
@push('css')

  <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
  <link href="{{asset('public/assets/plugins/jquery-jvectormap/jquery-jvectormap.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
  <link href="{{asset('public/assets/plugins/nvd3/build/nv.d3.css')}}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

@endpush
@section('title', 'Dashboard')
@section('content')
		<div class="content no_padding">

			<div class="alert alert-shadow alert-dismissable ">
	      <div class="notification-info">
          <h2 class="page-header no_margin"><i class="fas fa-home header-icon"></i> Dashboard <a href="{{URL::to('twitter-dashboard')}}" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i> Twitter login</a></h2>
        </div>
	    </div>
		</div>
		<!-- begin #content -->
		<div id="content" class="content">
			@include('backend.user.twitter.free.premium-top-header')
			<div class="row">
				<div class="col-sm-10">
					@foreach($getPlans as $plan)
	        <div class="col-sm-4">
	          <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
	            <div class="panel-heading text-center">
	              
	              <h3 class="panel-title capitalize">{{$plan->name}}</h3>
	              <!-- <p>{{$plan->description}}</p> -->
	            </div>
	            <div class="panel-body">
	              @foreach($plan->plan_package as $planPackage)
	              <div class="alert alert-info fade show">
	                 {{$planPackage->services->name}}
	              </div>
	              @endforeach
	            </div>
	            <div class="panel-footer text-center">
	              <div class="cell-view">
	                <div class="price"><b>{{$plan->monthly_price}} $</b><span>/per month</span></div>
	                <div class="clear"></div>
	                @if($plan->plan_category == 1)
	                <a class="btn btn-sm btn-success" href='{{URL::to("/twitter-dashboard")}}'>Free</a>
	                @else
	                <a class="btn btn-sm btn-success" href='{{URL::to("/premium/twitter/$plan->name/m")}}'>Get started</a>
	                @endif
	            </div>
	            
	            </div>
	          </div>
	        </div>  
	        @endforeach
	        
				</div>
				<div class="col-sm-2">
					@include('backend.user.twitter.free.ads_vertical')
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					@include('backend.user.twitter.free.ads_horizontal')
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