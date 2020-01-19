 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@section('title', 'Joined')
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-clock header-icon"></i> Twitter When Joined <small><i>check someone's exact time joined twitter.</i></small></h2>
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
              <!--  -->
            </div>
            <h4 class="panel-title">User </h4>
        </div>
        <?php 
          if(Session::has('twitterInfo')){
              $twitterInfo = Session::get('twitterInfo');
              $name = $twitterInfo['screen_name'];
          }else{
              $name = '';
          }
       ?>
        <div class="panel-body">
          <div class="list_of_service">
            <twitter-joined :username="{{json_encode($name)}}"></twitter-joined>
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