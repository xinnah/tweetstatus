 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-cogs header-icon"></i> Twitter unFollow <small><i>list of non followback unfollow user</i></small></h2>
    </div>
  </div>
</div>
<div id="content" class="content">

  <br>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">UnFollow</h4>
        </div>
        <?php 
        if(Session::has('twitterInfo')){
          $twitterUser = Session::get('twitterInfo');
        }else{
          $twitterUser = [];
        }
        ?>
        <div class="panel-body">
          <div class="list_of_service">
            <twitter-service-unfollow :user="{{json_encode($twitterUser)}}" :unfollowlist="{{json_encode($query)}}"></twitter-service-unfollow>
          </div>
        </div>
      </div>
      <!-- end panel -->
    </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->

@endsection