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
          <h2 class="page-header no_margin"><i class="fas fa-home header-icon"></i> Dashboard </h2>
        </div>
	    </div>
		</div>
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-gradient-teal">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">Total user's</div>
							<div class="stats-number">{{$totalUser}}</div>
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-gradient-blue">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">Active twitter user's</div>
							<div class="stats-number">{{$activeTwitterUser}}</div>
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-gradient-purple">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">Total twitter user's</div>
							<div class="stats-number">{{$totalTwitterUser}}</div>
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-gradient-black">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">Total active package</div>
							<div class="stats-number">{{count($getPlans)}}</div>
							
						</div>
					</div>
				</div>
				<!-- end col-3 -->
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
								{{$totalUser}}
								<small>Total user get service</small>
							</div>
							<div id="visitors-donut-chart" class="nvd3-inverse-mode p-t-10" style="height: 180px"></div>
							<ul class="chart-legend f-s-11">
								<li><i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> {{$activeTwitterUser}} <span>Service user</span></li>
								<li><i class="fa fa-circle fa-fw text-success f-s-9 m-r-5 t-minus-1"></i> <?php echo $totalTwitterUser - $activeTwitterUser; ?> <span>Free user</span></li>
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
								Package list	
							</h4>
						</div>
						<div id="visitors-map" class="bg-black" style="height: 179px;"></div>
						<div class="list-group">
							
							@foreach($getPlans as $plan)
							<a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis capitalize">
								{{$loop->index}}. {{$plan->name}}
								<!-- <span class="badge f-w-500 bg-gradient-teal f-s-10">20.95%</span> -->
							</a> 
							@endforeach
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