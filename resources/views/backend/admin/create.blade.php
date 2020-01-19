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
@section('title', 'Admin create')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Admin create</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > Administration > </small>Admin create Page</h1>
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
            <h4 class="panel-title">Admin create</h4>
        </div>

        <div class="panel-body">
          <div class="col-sm-offset-1 col-sm-10">
            <!-- admin create add section -->
            <div class="admin_create_section">
              {!! Form::open(array('route' => 'admin.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-4 control-label">First name</label>

                    <div class="col-md-12">
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-4 control-label">Last name</label>

                    <div class="col-md-12">
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Phone</label>

                    <div class="col-md-12">
                        <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required>

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('fk_role_id') ? ' has-error' : '' }}">
                    <label for="role" class="col-md-4 control-label">Role</label>

                    <div class="col-md-12">
                        <select name="fk_role_id" class="form-control" id="role" required>
                          <option> - select -</option>
                          @foreach($getRole as $role)
                          <option value="{{$role->id}}">{{$role->role_name}}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('fk_role_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fk_role_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" required>

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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
              {!! Form::close(); !!}
            </div>
          </div>
        	
          <!-- admin create end section -->
          
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