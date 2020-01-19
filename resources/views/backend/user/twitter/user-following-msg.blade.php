@extends('backend.layouts.app') 
@section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@section('title', 'User following message setup')
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="far fa-envelope"></i> Twitter user following message <small><i>setup user following message</i></small></h2>
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
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">User following message</h4>
        </div>

        <div class="panel-body">
          <div class="list_of_message_setup">
            <div class="col-sm-offset-2 col-sm-8">
              <div class="message_section">
                {!! Form::open(array('url' => 'twitter-following-message-setup','class'=>'form-horizontal','method'=>'POST')) !!}
                {!! csrf_field() !!}
                @if(isset($getMsg) && count($getMsg) > 0)
                @php 
                  $status = $getMsg->status;
                  $msg = $getMsg->msg; 
                @endphp
                @else
                @php
                  $status = 1;
                  $msg = '';
                @endphp
                @endif
                <div class="form-group">
                  <label class="textright   control-label col-md-4 col-sm-4">Status :</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio1" @if($status=="1"){{"checked"}}@endif>
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"name="status" id="inlineRadio2" value="0" @if($status=="0"){{"checked"}}@endif>
                    <label class="form-check-label" for="inlineRadio2">Inactive</label>
                  </div>
                  
                </div>
                <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                  <label for="message" class="textright col-md-4 control-label">Message</label>
                  <div class="col-md-8">
                    <textarea name="msg" id="message" class="form-control" rows="10" required><?php echo $msg; ?></textarea>
                    @if ($errors->has('msg'))
                      <span class="help-block">
                          <strong>{{ $errors->first('msg') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-success btn-sm" id="search-btn">
                        Setup
                      </button>
                  </div>
                </div>
                {!! Form::close(); !!}
              </div>
            </div>
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