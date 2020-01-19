@extends('backend.layouts.app')
@push('css')
 <style>
   .setup_section{width: 100%; margin: 18px auto; text-align: center;}
 </style>
@endpush 
@section('title', 'Synchronizing')
@section('content')

<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-search-plus header-icon"></i> Twitter setup </h2>
    </div>
  </div>
</div>
<div id="content" class="content">
  @if($userType == 'free')
  @include('backend.user.twitter.free.premium-top-header')
  <div class="top_ads">
    @include('backend.user.twitter.free.ads_horizontal')
  </div>
  @endif
  <br>
  <!-- start row -->
  <div class="row">
    <div class="{{ $userType == 'free' ? 'col-sm-10' : 'col-sm-12'}}">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> --}}
            </div>
            <h4 class="panel-title">Setup twitter</h4>
        </div>

        <div class="panel-body">
          <div class="alert alert-warning alert-dismissable ">
            <div class="notification-warning">
              <b class="pull-left notification-sender"><span class="alert-icon"><img src="{{asset('public/loader-cycle.gif')}}" style="width: 30px;"> </span> Please wait for setup to finish its job, otherwise your stats will not be accurate.</b><br>
            </div>
          </div>
        	<setup-twitter :user="{{ json_encode($user)}}"></setup-twitter>  
        </div>
      </div>
      <!-- end panel -->
    </div>
    @if($userType == 'free')
    <div class="col-sm-2 no_padding">
      @include('backend.user.twitter.free.ads_vertical')
    </div>
    @endif
  </div>
  <!-- end row -->
</div>
<!-- end #content -->

@endsection