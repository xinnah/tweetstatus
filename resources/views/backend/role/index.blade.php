@extends('backend.layouts.app')
@push('css')
<style>
  .form_delete {
      display: inline;
  }
  
  .form-group {
      display: block !important;
  }
</style>
@endpush
@section('title', 'Role')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Role</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > Administration > Role Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Role</h4>
        </div>

        <div class="panel-body">
        	@include('notify.crud_notify')
          <!-- role add section -->
          <div class="role_add_section">
            <div class="add_more">
              <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">Add New Role</a>
            </div>
						
						<!-- Modal -->
						<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Create new role</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      {!! Form::open(array('route' => 'role.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
						      <div class="modal-body">
						        {!! csrf_field() !!}

                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4">Role status :</label>
                      <div class="form-check form-check-inline">
											  <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio1" checked>
											  <label class="form-check-label" for="inlineRadio1">Active</label>
											</div>
											<div class="form-check form-check-inline">
											  <input class="form-check-input" type="radio"name="status" id="inlineRadio2" value="0">
											  <label class="form-check-label" for="inlineRadio2">Inactive</label>
											</div>
                      
                    </div>

                    <div class="form-group col-md-12">
                      <label class="control-label col-md-4 col-sm-4 no_padding">Role name :</label>
                        <input type="text" class="form-control" name="role_name" value="" placeholder="Enter role name">
                      
                    </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
						      </div>
						      {!! Form::close(); !!}
						    </div>
						  </div>
						</div>
            <!-- #create -->
            
          </div>
          <!-- role add section -->
          <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
            <thead>
              <tr>
                <th>SL.</th>
                <th>Role Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0; ?>
                @foreach($getRole as $role)
                  <tr>
                    <td>{{++$i}}</td>
                    <td>{{$role->role_name}}</td>
                    <td>
                        @if($role->status == 1) Active @else Inactive @endif

                    </td>
                    <td>
                      <!-- edit role section start -->

                      <a data-target="#update{{$role->id}}" class="btn btn-sm btn-info" data-toggle="modal"><i class="fas fa-edit"></i></a>

                        <!-- #update -->
                      <div class="modal fade" id="update{{$role->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                            	<h4 class="modal-title">{{$role->role_name}}</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              
                            </div>
                            {!! Form::open(array('route' => ['role.update',$role->id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true')) !!}
                            <div class="modal-body">

                              {!! csrf_field() !!}
                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-4">Role Status :</label>
                                  <div class="form-check form-check-inline">
																	  <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio1" @if($role->status=="1"){{"checked"}}@endif>
																	  <label class="form-check-label" for="inlineRadio1">Active</label>
																	</div>
																	<div class="form-check form-check-inline">
																	  <input class="form-check-input" type="radio"name="status" id="inlineRadio2" value="0" @if($role->status=="0"){{"checked"}}@endif>
																	  <label class="form-check-label" for="inlineRadio2">Inactive</label>
																	</div>
                                  
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-4">Role Name :</label>
                                  <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" name="role_name" value="{{$role->role_name}}">
                                  </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                              <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </div>
                            {!! Form::close(); !!}
                          </div>
                        </div>
                      </div>
                      <!-- edit role section end -->

                      <!-- delete role section -->
                      {!! Form::open(array('route'=> ['role.destroy',$role->id],'method'=>'DELETE','class'=>'form_delete')) !!} {{ Form::hidden('id',$role->id)}}
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
      <!-- end panel -->
    </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
@push('js')

@endpush
@endsection