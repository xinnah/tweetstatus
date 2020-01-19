@extends('backend.layouts.app') 
@section('title', 'Profile edit')
@section('content')
@push('css')
  <style type="text/css">
    .panel {border: 1px solid #efefef; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05); }
    .panel-heading {padding: 5px 15px;}  
  
  </style>
@endpush
<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Account settings</li>
  </ol>
  <h1 class="page-header"><small>Dashboard > Account settings Page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse" id="account-info">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              {{-- <a href="{{URL::to('/view-Account settings')}}" class="btn btn-xs btn-warning"><i class="fa fa-eye"> view Account settings</i></a>
              <a href="{{URL::to('/change-password')}}" class="btn btn-xs btn-info"><i class="fa fa-edit">Change password</i></a> --}}
            </div>
            <h4 class="panel-title">Account settings</h4>
        </div>

        <div class="panel-body">
        	<div class="col-sm-6 col-sm-offset-3" style="font-size: 12px;">
            <div class="panel">
              <div class="panel-heading">
                <div class="heading text-center"><h1 class="title">Account Information </h1></div>
              </div>
              <div class="panel-body">
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
                    <div class="col-md-12">
                      <button type="submit" name="btn_login" id="btn_login" class="btn btn-default align-center">Update</button>
                    </div>
                  </div>
                {!! Form::close(); !!}
                <div class="form-group">
                    <div class="col-md-12">
                      <label for="report_email" class="control-label">Get daily reports via email <input type="checkbox" id="report_email" ></label>
                      
                    </div>
                  </div>
              </div>
            </div>
            <br>
            <div class="panel" id="password-change">
              <div class="panel-heading">
                <div class="heading text-center"><h1 class="title">Change your password </h1></div>
              </div>
              <div class="panel-body">
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
                      <label for="password" class="col-md-4 control-label">New Password</label>

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
                    <div class="col-md-12">
                      <button type="submit" name="btn_login" id="btn_login" class="btn btn-default align-center">Update</button>
                    </div>
                  </div>
                {!! Form::close(); !!}
              </div>
            </div>
            <br>
            @if($getUser->role->role_name == 'user')
            @if($premium == false)
            <div class="panel" id="invoice_section">
              <div class="panel-heading">
                <div class="heading text-center"><h1 class="title">Your subscription </h1></div>
              </div>
              <div class="panel-body">
                <div class="invoice_table_section text-center">
                  <div class="panel">
                    <div class="panel-body">
                      <h4>You don't have any plan.</h4>
                      <a href="{{URL::to('/plan')}}"><button type="button" name="btn_login" id="btn_login" class="btn btn-default align-center">Choose your plan</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            @endif
            <div class="panel" id="invoice_section">
              <div class="panel-heading">
                <div class="heading text-center"><h1 class="title">Invoices </h1></div>
              </div>
              <div class="panel-body">
                <div class="invoice_table_section">
                  <table id="data-table" class="table table-striped table-bordered nowrap table-info" width="100%">
                    <thead>
                      <tr>
                        <th>Sl.</th>
                        <th>Date</th>
                        <th>Order</th>
                        <th>Amount</th>
                        <th>Invoice</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=0; ?>
                      @if(count($getPackageHistory) > 0)
                      @foreach($getPackageHistory as $package)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $package->created_at }}</td>
                        <td>{{ $package->plan_package->name }}</td>
                        <td>{{ $package->plan_package->monthly_price }}</td>
                        <td>
                          @php
                            $invoiceUrl = $package->start_date."_".$package->id;
                          @endphp
                          <a href='{{URL::to("user-invoice?id=$invoiceUrl")}}' target="_blank">{{ $package->start_date }}_{{ $package->id }}</a>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                        <td colspan="5">There are no invoice for you</td>
                      </tr>
                      @endif
                    </tbody>
                  </table> 
                 
                </div>
              </div>
            </div> 
            @endif
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
  <script type="text/javascript">
    $(document).ready(function () {
    @if(Session::has('status'))
    @if( Session::get('status') == 2)
    
      $('html, body').animate({
          scrollTop: $('#password-change').offset().top
      }, 'slow');
    @else
      $('html, body').animate({
          scrollTop: $('#account-info').offset().top
      }, 'slow');
    @endif
    @endif

    });
  </script>

  <script src="{{asset('public/assets/plugins/highlight/highlight.common.js')}}"></script>
  <script src="{{asset('public/assets/js/demo/render.highlight.js')}}"></script>
  <script>
    $(document).ready(function() {
        Highlight.init();
    });
  </script> 
@endpush
@endsection