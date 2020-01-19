@extends('backend.layouts.app') 
@push('css')
<style type="text/css">
  .typeahead{width:100%; font-size: 12px;}
</style>
     
@endpush
@section('title', 'Plan package')
@section('content')
<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Plan package view</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > </small>Plan package view Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="{{URL::to('/plan-package/create')}}" class="btn btn-sm btn-success" >Create plan</a>
              <a href="{{URL::to('/plan-package')}}" class="btn btn-sm btn-info" >Lists of plan</a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Plan package view</h4>
        </div>

        <div class="panel-body">
          <div class="view_plan_package_section">
            <div class="plan_view text-center">
              <h3 >{{ $getPlan->name }}</h3>
              <small><b>monthly : {{ $getPlan->monthly_price }} $</b></small>
              
            </div>
            <div class="service_add">
              <div class="offset-sm-3 col-sm-6 ">
                {!! Form::open(array('url' => 'plan-package-set','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                {{ csrf_field() }}
              <br>
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  {!! Form::hidden('fk_plan_id', "$getPlan->id") !!}
                  <div class="col-md-12">
                    {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text', 'placeholder' =>'Type service name...','autocomplete'=>'off')) !!}
                      
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary btn-sm">
                          Confirm
                      </button>
                  </div>
              </div>
            {!! Form::close(); !!}
              </div>

            </div>
            <div class="list_of_service">
              <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Service name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; ?>
                    @if(isset($getPackage))
                    @foreach($getPackage as $package)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{$package->services->name}}</td>
                        <td>
                          <!-- delete role section -->
                          {!! Form::open(array('url'=> ['plan-package-set/'.$package->id],'method'=>'POST','class'=>'form_delete')) !!} {{ Form::hidden('id',$package->id)}}
                          <button type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </button>
                          {!! Form::close() !!}
                          <!-- delete role section end -->
                        </td>
                      </tr>
                    @endforeach
                    @endif
                </tbody>
              </table>
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
@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  
<script type="text/javascript">

      var url = "{{ route('service-name.response') }}";

      $('#search_text').typeahead({

          source:  function (query, process) {

          return $.get(url, { query: query }, function (data) {

                  return process(data);

              });

          }

      });

  </script>
@endpush
@endsection