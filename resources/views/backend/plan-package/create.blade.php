@extends('backend.layouts.app') 
@section('title', 'Plan package create')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Plan package</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > </small>Plan package Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="{{URL::to('/plan-package')}}" class="btn btn-sm btn-success" >Lists of plan</a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Plan package</h4>
        </div>

        <div class="panel-body">
          @include('notify.crud_notify')
        	<div class="plan_package_section">
           <div class="offset-sm-2 col-sm-8 ">
             {!! Form::open(array('route' => 'plan-package.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true')) !!}
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <label class="control-label col-md-4 col-sm-4">Status :</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1" id="inlineRadio1" checked>
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                    <label class="form-check-label" for="inlineRadio2">Inactive</label>
                  </div>
                      
              </div>
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-12 control-label">Name</label>

                  <div class="col-md-12">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('plan_category') ? ' has-error' : '' }}">
                  <label for="plan_category" class="col-md-12 control-label">Category</label>

                  <div class="col-md-12">
                      <select name="plan_category" class="form-control" id="plan_category">
                        <option value="1">Free manual system</option>
                        <option value="2">Premium manual system</option>
                        <option value="3">Premium Auto system</option>
                      </select>

                      @if ($errors->has('plan_category'))
                          <span class="help-block">
                              <strong>{{ $errors->first('plan_category') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('tag_limit') ? ' has-error' : '' }}">
                  <label for="tag_limit" class="col-md-12 control-label">Limit hashtag</label>

                  <div class="col-md-12">
                      <input id="tag_limit" type="number" class="form-control" name="tag_limit" value="0" required>

                      @if ($errors->has('tag_limit'))
                          <span class="help-block">
                              <strong>{{ $errors->first('tag_limit') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              
              <input type="hidden" name="plan_type" value="1">
              <div class="form-group{{ $errors->has('monthly_price') ? ' has-error' : '' }}">
                  <label for="monthly_price" class="col-md-12 control-label">Price</label>

                  <div class="col-md-12">
                      <input id="monthly_price" type="number" step="any" min="0" step="0.01" class="form-control" name="monthly_price" value="0" required>

                      @if ($errors->has('monthly_price'))
                          <span class="help-block">
                              <strong>{{ $errors->first('monthly_price') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('following') ? ' has-error' : '' }}">
                  <label for="following" class="col-md-12 control-label">Following (If You set unlimited then type unlimited otherwise type digit number) Ex. unlimited / 200</label>

                  <div class="col-md-12">
                      <input id="following" type="text" class="form-control" name="following" value="0" required>

                      @if ($errors->has('following'))
                          <span class="help-block">
                              <strong>{{ $errors->first('following') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('unfollowing') ? ' has-error' : '' }}">
                  <label for="unfollowing" class="col-md-12 control-label">UnFollowing (If You set unlimited then type unlimited otherwise type digit number) Ex. unlimited / 200 </label>

                  <div class="col-md-12">
                      <input id="unfollowing" type="text" class="form-control" name="unfollowing" value="0" required>

                      @if ($errors->has('unfollowing'))
                          <span class="help-block">
                              <strong>{{ $errors->first('unfollowing') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('mute') ? ' has-error' : '' }}">
                  <label for="mute" class="col-md-12 control-label">Mute (If You set unlimited then type unlimited otherwise type digit number) Ex. unlimited / 200</label>

                  <div class="col-md-12">
                      <input id="mute" type="text" class="form-control" name="mute" value="0" required>

                      @if ($errors->has('mute'))
                          <span class="help-block">
                              <strong>{{ $errors->first('mute') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('block') ? ' has-error' : '' }}">
                  <label for="block" class="col-md-12 control-label">Block (If You set unlimited then type unlimited otherwise type digit number) Ex. unlimited / 200</label>

                  <div class="col-md-12">
                      <input id="block" type="text" class="form-control" name="block" value="0" required>

                      @if ($errors->has('block'))
                          <span class="help-block">
                              <strong>{{ $errors->first('block') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              
              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description" class="col-md-12 control-label">Description</label>

                  <div class="col-md-12">
                      <textarea class="form-control" id="description" rows="5" name="description"></textarea>

                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              
              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Confirm
                      </button>
                  </div>
              </div>
            {!! Form::close(); !!}
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