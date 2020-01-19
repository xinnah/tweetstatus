 @extends('backend.layouts.app') 
 @section('title', 'List of admin and service')
 @section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Admin</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > Administration > </small>Admin Page</h1>
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
            <h4 class="panel-title">Admin</h4>
        </div>

        <div class="panel-body">
        	<div class="admin_list_section">
             <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                  @foreach($getAdmin as $admin)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$admin->first_name}}</td>
                      <td>{{$admin->last_name}}</td>
                      <td>{{$admin->email}}</td>
                      <td>{{$admin->role->role_name}}</td>
                      <td>{{$admin->phone}}</td>
                      <td>
                          @if($admin->status == 1) Active @else Inactive @endif

                      </td>
                      <td>
                        <!-- delete role section -->
                        {!! Form::open(array('route'=> ['admin.destroy',$admin->id],'method'=>'DELETE','class'=>'form_delete')) !!} {{ Form::hidden('id',$admin->id)}}
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
            <div class="pagination">
              {{ $getAdmin->links() }}
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