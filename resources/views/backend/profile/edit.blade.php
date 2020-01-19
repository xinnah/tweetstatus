@extends('backend.layouts.app') 
@section('title', 'Profile edit')
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
              <a href="{{URL::to('/view-profile')}}" class="btn btn-xs btn-warning"><i class="fa fa-eye"> view profile</i></a>
              <a href="{{URL::to('/change-password')}}" class="btn btn-xs btn-info"><i class="fa fa-edit">Change password</i></a>
            </div>
            <h4 class="panel-title">Profile</h4>
        </div>

        <div class="panel-body">
        	<div class="col-sm-6 col-sm-offset-3" style="font-size: 12px;">
            {!! Form::open(array('url' => 'update-profile','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <label for="first_name" class="col-md-4 control-label">First name</label>

                  <div class="col-md-12">
                      <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $getUser->first_name }}" required autofocus>

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
                      <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $getUser->last_name }}" required autofocus>

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
                      <input id="phone" type="tel" class="form-control" name="phone" value="{{ $getUser->phone }}" required>

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
                      <input id="email" type="email" class="form-control" name="email" value="{{ $getUser->email }}" required>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
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