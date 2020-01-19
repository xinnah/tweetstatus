@extends('backend.layouts.app') 
@section('title', 'List of plan package')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li> 
      <li class="active"> <a href="javascript:;">plans</a></li>
  </ol>
  <h1 class="page-header"><small>Dashboard > </small>plans Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="{{URL::to('/plan-package/create')}}" class="btn btn-sm btn-success" >Create plan</a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">plans</h4>
        </div>

        <div class="panel-body">
        	@include('notify.crud_notify')
          <div class="list_of_service">
            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Plan name</th>
                  <th>Plan type</th>
                  <th>Plan category</th>
                  <th>Monthly price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                  
                  @foreach($getPlan as $plan)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$plan->name}}</td>
                      <td>
                        @if($plan->plan_type == 1)
                          Twitter
                        @else
                          Instagram
                        @endif
                      </td>
                      <td>
                        @if($plan->plan_category == 1)
                          Free manual system
                        @elseif($plan->plan_category == 2)
                          Premium manual system
                        @else
                          Auto system
                        @endif
                      </td>
                      <td>{{$plan->monthly_price}}</td>
                      <td>{{$plan->status}}</td>
                      <td>
                        {{-- <a href='{{URL::to("plan-package/$plan->id")}}' class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a> --}}
                        <a href='{{URL::to("plan-package/$plan->id/edit")}}' class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <!-- delete role section -->
                        {!! Form::open(array('route'=> ['plan-package.destroy',$plan->id],'method'=>'DELETE','class'=>'form_delete')) !!} {{ Form::hidden('id',$plan->id)}}
                        <button type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        {!! Form::close() !!}
                        <!-- delete role section end -->
                      </td>
                    </tr>
                  @endforeach
                  
              </tbody>
            </table>
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