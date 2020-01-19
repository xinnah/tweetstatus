@extends('backend.layouts.app') 
@section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="{{asset('public/assets/css/hot-topics.css')}}" rel="stylesheet" />
@endpush
@section('title', 'Search followers')
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-search-plus header-icon"></i> Twitter search follower <small><i>search new followers on trend topics</i></small></h2>
    </div>
  </div>
</div>
<div id="content" class="content">
  
  <!-- start row -->
  <div class="row">
    <div class="col-sm-9">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">search</h4>
        </div>
        <?php 
          if(count($getResult) > 0){
            $divShow = 1;
            $keyword = $getResult['keyword'];
            if(isset($getResult['location'])){
              $location = $getResult['location'];
            }else{
              $location = '';
            }
            $minfollower = $getResult['minfollower'];
            $mintweets = $getResult['mintweets'];
          }else{
            $divShow = 0;
            $keyword = '';
            $location = '';
            $minfollower = 10;
            $mintweets = 10;
          }
         ?>
        <div class="panel-body">
          <div class="search_option_section">
            {!! Form::open(array('url' => 'twitter-search','class'=>'form-horizontal','method'=>'GET','files'=>'true')) !!}
            <input type="hidden" name="do-search" value="x">
            <div class="row">
              <div class="col-md-offset-3 col-md-6">
                <div class="form-group">
                  <label for="keyword" class="col-md-12 control-label">Keyword</label>
                  <div class="col-md-12">
                    <input id="keyword" type="text" class="form-control" name="keyword" placeholder="Type keyword" value="{{$keyword}}" required autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pac-input" class="col-md-12 control-label">Location</label>
                  <div class="col-md-12">
                    <input id="pac-input" name="location" class="form-control" value="{{$location}}" type="text" placeholder="Type location">
                    <div id="map"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="max" class="col-md-12 control-label">Minimum Followers</label>
                  <div class="col-md-12">
                    <input id="max" type="number" class="form-control" name="minfollower" min="0" value="{{$minfollower}}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="max" class="col-md-12 control-label">Minimum Tweets</label>
                  <div class="col-md-12">
                    <input id="max" type="number" class="form-control" name="mintweets" min="0" value="{{$mintweets}}" required>
                  </div>
                </div>
                {!! csrf_field() !!}
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary btn-sm" id="search-btn">
                          Search
                      </button>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close(); !!}
          </div>
          <div class="search_result_section">
            @if($divShow == 1)
            <twitter-search :keyword="{{json_encode($keyword)}}" :location="{{json_encode($location)}}" :minfollower="{{json_encode($minfollower)}}" :mintweets="{{json_encode($mintweets)}}"></twitter-search>
            @endif
          </div>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <div class="col-sm-3 no_padding">
      @include('backend.user.twitter.hot-topics')
    </div>
    
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
@push('js')
<script>
  function initAutocomplete() {
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }
    });
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4&libraries=places&callback=initAutocomplete" async defer></script>
@endpush
@endsection