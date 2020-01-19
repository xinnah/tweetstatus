 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <style>
      .control-label{text-align: right !important;}
      .alert-dismissable .close, .alert-dismissible .close {right: 0 !important;}
    </style>
@endpush
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-search-plus header-icon"></i> Twitter tweet <small><i>schedule tweet create</i></small></h2>
    </div>
  </div>
</div>
<div id="content" class="content">
  
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">

      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="{{URL::to('twitter-tweets')}}" class="btn btn-sm btn-success">List of tweets</a>
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">tweet</h4>
        </div>
        <div class="panel-body">
          
          <div class="search_option_section">
            {!! Form::open(array('route' => 'twitter-tweets.store','class'=>'form-horizontal','method'=>'POST','files'=>'true')) !!}
            <div class="row">
              <div class="col-md-offset-1 col-md-10">
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="Date" class="col-md-4 control-label">Schedule date</label>
                  <div class="col-md-4">
                    <input id="Date" type="date" class="form-control" name="date" value="<?php echo date("Y-m-d"); ?>" required>
                    @if ($errors->has('date'))
                      <span class="help-block">
                          <strong>{{ $errors->first('date') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="col-md-4">
                    <input id="Date" type="time" class="form-control" name="time" value="<?php echo date("H:i"); ?>" required>
                    @if ($errors->has('time'))
                      <span class="help-block">
                          <strong>{{ $errors->first('time') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="currentDate">
                <input type="hidden" value="<?php echo date("H:i"); ?>" name="currentTime">
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                  <label for="content" class="col-md-4 control-label">Content</label>
                  <div class="col-md-8">
                    <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
                    @if ($errors->has('content'))
                      <span class="help-block">
                          <strong>{{ $errors->first('content') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                
                
                {!! csrf_field() !!}
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-success btn-sm" id="search-btn">
                        Tweet
                      </button>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close(); !!}
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