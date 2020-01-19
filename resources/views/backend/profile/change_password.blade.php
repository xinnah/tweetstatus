@extends('backend.layouts.app') 
@section('title', 'Change password')
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
              <a href="{{URL::to('/edit-profile')}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"> Edit profile</i></a>
              <a href="{{URL::to('/view-password')}}" class="btn btn-xs btn-info"><i class="fa fa-edit">View profile</i></a>
            </div>
            <h4 class="panel-title">Change password</h4>
        </div>

        <div class="panel-body">
        	<div class="col-sm-6 col-sm-offset-3" style="font-size: 12px;">
            {!! Form::open(array('url' => 'update-password','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                  <label for="old_password" class="col-md-4 control-label">Old password</label>

                  <div class="col-md-12">
                    <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Type old password" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-4 control-label">Password</label>

                  <div class="col-md-12">
                      <input id="password" type="password" class="form-control" name="password" placeholder="Type new password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                  <div class="col-md-12">
                      <input id="password-confirm" type="password" class="form-control" placeholder="Type confirm password"  name="password_confirmation" required>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Update
                      </button>
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
@push('js')

@endpush
@endsection