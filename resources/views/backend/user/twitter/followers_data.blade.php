@extends('backend.layouts.app') 

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@section('title', 'Followers')
@section('content')
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-users header-icon"></i> Twitter Followers <small><i>list of users who followed you</i></small></h2>
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
  <div class="row">
    <div class="alert alert-warning alert-dismissable " style="width: 80%; background: #fdf0d4;">
        
      <div class="notification-info">
        <div class="col-sm-12">
          <div class="col-sm-1">
            <span class="alert-icon twitter-share-icon"><i class="far fa-bell"></i></span>
          </div>
          <div class="col-sm-11 no_padding">
            @php
              $getSidebar = Session::get('sidebar');
              $followers = $getSidebar['followers_new'];
            @endphp

            <share-on-twitter :data="{{json_encode($followers)}}"></share-on-twitter>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!-- start row -->
  <div class="row">
    <div class="{{ $userType == 'free' ? 'col-sm-10' : 'col-sm-12'}}">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">followers</h4>
        </div>

        <div class="panel-body">
          <div class="list_of_service">
            <twitter-get-data :getids="{{json_encode($getId)}}" :type="{{json_encode('followers')}}"></twitter-get-data>
          </div>
          <div class="paginate">
            {{ $getId->links()}}
          </div>
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