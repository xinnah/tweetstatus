@extends('backend.layouts.app') 
@section('content')
@push('css')
  <style type="text/css">
    .switcher{display: inline-block;}
    .control-label{text-align: left !important;}
  </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
      .setting_section .panel { border: groove;}
    </style>
@endpush
@section('title', $type)
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
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">{{$type}}</h4>
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

            <twitter-settings :user="{{json_encode($twitterUser)}}" :type="{{json_encode($type)}}" :getdata="{{json_encode($getData)}}" :hashtag="{{$hashtag}}"></twitter-settings>
            
          </div>
        </div>
      </div>
      <!-- end panel -->
    </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
@push('js')
<script src="{{asset('public/assets/plugins/highlight/highlight.common.js')}}"></script>
  <script src="{{asset('public/assets/js/demo/render.highlight.js')}}"></script>
<script>
  $(document).ready(function() {
      Highlight.init();
  });
</script> 
@endpush
@endsection