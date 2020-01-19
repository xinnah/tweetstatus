 @extends('backend.layouts.app') 
 @section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Admin</li>
  </ol>
  <h1 class="page-header"><small>List of instagram users page</h1>
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
            <h4 class="panel-title">Users</h4>
        </div>

        <div class="panel-body">
        	<div class="admin_list_section">
             <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>instagram id</th>
                  <th>User name</th>
                  <th>Full name</th>
                  <th>Profile image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($getUser as $user) 
                <tr>
                  <td>{{++$i}}</td>
                  <td>{{$user->instagram_id}}</td>
                  <td>{{$user->username}}</td>
                  <td>{{$user->full_name}}</td>
                  <td><img src="{{$user->profile_picture}}" alt="{{$user->username}}" style="width: 20%"></td>
                  <td><a href="" class="btn btn-info">Access</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="pagination">
              {{ $getUser->links() }}
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