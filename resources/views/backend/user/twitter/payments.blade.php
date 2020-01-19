 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-unlink header-icon"></i> Twitter Payment  <small><i>go premium, remove limits.</i></small></h2>
    </div>
  </div>
</div>
<div id="content" class="content">

  <br>
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
            <h4 class="panel-title">Payment</h4>
        </div>
        <div class="panel-body">
          <div class="twitter-payment-section">
            <div class="alert alert-success alert-dismissable ">
        
              <div class="notification-info">
                <p><i class="fas fa-dot-circle"></i> You are signing up for Premium Account Membership. Your monthly payment will be $5.99</p>
                <p><i class="fas fa-dot-circle"></i> You can cancel your subscription anytime and you will be able to use Premium features until your next billing date.</p>
              </div>
            </div>
            <div class="form-group row m-b-15">
              <label class="col-md-3 col-form-label">Card Holder</label>
              <div class="col-md-7">
                <input type="text" class="form-control" placeholder="Full name" />
              </div>
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