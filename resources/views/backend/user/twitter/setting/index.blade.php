 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
      .setting_section .panel { border: groove; text-align: center;}
    </style>
@endpush
@section('title', 'Twitter settings')
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-cogs header-icon"></i> Twitter settings <small><i>settings your twitter</i></small></h2>
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
              
            </div>
            <h4 class="panel-title">Settings</h4>
        </div>
        <?php 
        if(Session::has('twitterInfo')){
          $twitterUser = Session::get('twitterInfo');
        }else{
          $twitterUser = [];
        }
        ?>
        <div class="panel-body">
          <div class="setting_section">

            
            <div class="row">
              <div class="col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="panel-section">
                      <h3>Follow unfollow</h3>
                      <hr>
                      <p>Increase your twitter follower</p>
                      <a href="{{URL::to('twitter-settings/follow-unfollow-setup')}}" class="btn btn-success">Setup now</a>
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- <div class="col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="panel-section">
                      <h3>Re-Tweet like</h3>
                      <hr>
                      <p>Setup your twitter Re-Tweet like</p>
                      <a href="{{URL::to('twitter-settings/retweet-like-setup')}}" class="btn btn-success">Setup now</a>
                    </div>
                  </div>
                  
                </div>
              </div> -->
              
            </div>
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