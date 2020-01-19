@extends('backend.layouts.app') 
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@section('title', 'Finalize your account')
@section('content')

<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-cogs header-icon"></i> Twitter settings <small><i>confrim your twitter account.</i></small></h2>
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
          <div class="list_of_service text-center">

            <h2>Finalize your account</h2>
            <p>{{ $twitterUser['name'] }}</p>
            {!! Form::open(array('url'=> 'premium-account-set-confirm','method'=>'POST','class'=>'submit')) !!} 
              {{ Form::hidden('tid',$twitterUser['id_str'])}}
              <button class="btn btn-success">Confirm</button>
            {!! Form::close() !!}
            <br>
            <h4><b style="color:red">* if your not please logout and login which account are confirm.</b></h4>
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