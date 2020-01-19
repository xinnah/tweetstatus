 @extends('backend.layouts.app') 
 @section('title', 'Schedule tweets')
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
      <h2 class="page-header no_margin"><i class="fas fa-search-plus header-icon"></i> Twitter tweets <small><i>schedule tweets list</i></small></h2>
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
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->
              
            </div>
            <h4 class="panel-title">tweets</h4>
        </div>

        <div class="panel-body">
          <div class="show">
            <tweet-calendar :events="{{json_encode($getResults)}}"></tweet-calendar>
          </div>
          <div class="select_day">
            <div class="overlay-modal overlay-modal-calender" style="margin-left: 0px; display: none;">
              <div class="travel_dialog show_travel_modal">
                <div class="fade-box-calender fade-box">
                  <div class="inner_gray clearfix">
                    <div class="inner_gray_text">
                    Schedule Tweet 
                    </div>
                    <div class="inner_gray_close_button">
                      <a class="close cancel_modal" role="button" title="Close">Close</a>
                    </div>
                  </div>
                  <div class="inner_body">
                    <div class="inner_body_content">
                      <div class="alert alert-danger" id="response-error" role="alert" style="display: none"></div>
                      <div class="row">
                        <div class="form-group">
                          <label for="Date" class="col-md-4 control-label">Schedule date</label>
                          <div class="col-md-8 no_padding">
                            <datetime
                              type="datetime"
                              v-model="datetimedata"
                              hidden-name="datetime"
                              input-id="date-time"
                              value-zone="Asia/Dhaka"
                              zone="Asia/Dhaka"
                              :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' }"
                              :phrases="{ok: 'Continue', cancel: 'Exit'}"
                              use12-hour
                              auto
                              ></datetime>
                          </div>
                        </div>
                        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="currentDate">
                        <input type="hidden" value="<?php echo date("H:i"); ?>" name="currentTime">
                        <div class="form-group">
                          <label for="content" class="col-md-4 control-label">Color</label>
                          <div class="col-md-8 no_padding">
                            <select name="color" class="form-control">
                              <option value="default">Default</option>
                              <option value="red">Red</option>
                              <option value="green">Green</option>
                              <option value="black">Black</option>
                            </select>
                          </div>
                        </div>
                        {{-- <div class="form-group">
                          <label for="content" class="col-md-4 control-label">File</label>
                          <div class="col-md-8 no_padding">
                            <input type="file" name="file" class="form-control">
                          </div>
                        </div> --}}
                        <div class="form-group">
                          <label for="content" class="col-md-4 control-label">Content</label>
                          <div class="col-md-8 no_padding" id="content-section">
                            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                            <div class="alert alert-danger" id="content-error" role="alert" style="display: none"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                            <button type="button" id="tweet-post" class="btn btn-info btn-sm" id="search-btn" >
                              Tweet
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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