@extends('layouts.app')
@section('title', 'Create an Account')
@section('content')
<div class="container mt10">
    <div class="row" id="content-wrapper">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><div class="heading text-center"><h1 class="title">Create an Account</h1></div></div>
                @include('notify.crud_notify')
                
                <div class="panel-body">
                    {!! Form::open(array('route' => 'users.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                              <label for="first_name" class="col-md-4 control-label">First name</label>

                              <div class="col-md-6">
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

                              <div class="col-md-6">
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

                              <div class="col-md-6">
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

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
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

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                            <div class="my-sm-gutter"></div>
                            <p class="text-center">Already have an account? <a href="{{URL::to('/login')}}">LOGIN</a></p>
                        </div>
                    {!! Form::close(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
