 @extends('backend.layouts.app') 
 @section('content')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
<!-- begin #content -->
<div class="content no_padding">
  <div class="alert alert-shadow alert-dismissable ">
    <div class="notification-info">
      <h2 class="page-header no_margin"><i class="fas fa-unlink header-icon"></i> Twitter Plan <small><i>go premium, remove limits and ads.</i></small></h2>
    </div>
  </div>
</div>
<div id="content" class="content">

  <br>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="plans_section">
        @foreach($getPlans as $plan)
        <div class="col-sm-4">
          <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
            <div class="panel-heading text-center">
              
              <h3 class="panel-title">{{$plan->name}}</h3>
              <!-- <p>{{$plan->description}}</p> -->
            </div>
            <div class="panel-body">
              @foreach($plan->plan_package as $planPackage)
              <div class="alert alert-info fade show">
                 {{$planPackage->services->name}}
              </div>
              @endforeach
            </div>
            <div class="panel-footer text-center">
              <div class="cell-view">
                <div class="price"><b>{{$plan->monthly_price}} $</b><span>/per month</span></div>
                <div class="clear"></div>
                <a class="btn btn-sm btn-success" href='{{URL::to("/plan-premium/twitter/$plan->name/m")}}'>Get started</a>
            </div>
            
            </div>
          </div>
        </div>  
        @endforeach
      </div>  
      <!-- end panel -->
    </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->

@endsection