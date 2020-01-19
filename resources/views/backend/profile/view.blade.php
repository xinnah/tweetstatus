@extends('backend.layouts.app') 
@section('title', 'Profile view')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Profile</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > Profile Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              {{-- <a href="{{URL::to('/edit-profile')}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"> Edit profile</i></a>
              <a href="{{URL::to('/change-password')}}" class="btn btn-xs btn-info"><i class="fa fa-edit">Change password</i></a> --}}
            </div>
            <h4 class="panel-title">Profile</h4>
        </div>

        <div class="panel-body">
        	<div class="col-sm-6 col-sm-offset-3">
            <table class="table table-bordered" style="font-size: 14px;">
              <tr>
                <th scope="col">Role access</th>
                <td scope="col">{{$getUser->role->role_name}}</td>
              </tr>
              <tr>
                <th scope="col">First name</th>
                <td scope="col">{{$getUser->first_name}}</td>
              </tr>
              <tr>
                <th scope="col">Last name</th>
                <td scope="col">{{$getUser->last_name}}</td>
              </tr>
              <tr>
                <th scope="col">Email</th>
                <td scope="col">{{$getUser->email}}</td>
              </tr>
              <tr>
                <th scope="col">Phone</th>
                <td scope="col">{{$getUser->phone}}</td>
              </tr>

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
@push('js')

@endpush
@endsection