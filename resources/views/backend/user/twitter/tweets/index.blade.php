 @extends('backend.layouts.app') 
 @section('title', 'Twitter tweets')
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
              <a href="{{URL::to('twitter-schedule-tweets')}}" class="btn btn-sm btn-success">Schedule tweets</a>
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> -->
              
            </div>
            <h4 class="panel-title">tweets</h4>
        </div>

        <div class="panel-body">
          <div class="search_option_section">
            <table id="data-table" class="table table-striped table-bordered nowrap table-info" width="100%">
              <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Content</th>
                  <th width="30%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($getTweets as $tweet)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $tweet->date }}</td>
                  <td>{{ $tweet->time }}</td>
                  <td> <?php echo substr($tweet->content,0,150); ?></td>
                  <td class="text-right table-buttons">
                    <div class="btn-group">
                      <a href='{{URL::to("twitter-tweets/$tweet->id/edit")}}' class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
                      {!! Form::open(array('route'=> ['twitter-tweets.destroy',$tweet->id],'method'=>'DELETE','class'=>'form_delete')) !!} {{ Form::hidden('id',$tweet->id)}}
                      <button type="submit" onclick="return confirmDelete();" class="btn btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      {!! Form::close() !!}
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table> 
            {{$getTweets->links()}}
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