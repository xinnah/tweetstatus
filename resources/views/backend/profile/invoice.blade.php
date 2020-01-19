@extends('backend.layouts.app') 
@section('title', 'Invoice show')
@section('content')

<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb hidden-print pull-right">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item active">Invoice</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header hidden-print">Invoice <small>header small text goes here...</small></h1>
		<!-- end page-header -->
		<!-- begin invoice -->
		<div class="invoice">
			<!-- begin invoice-company -->
			<div class="invoice-company text-inverse f-w-600">
				<span class="pull-right hidden-print">
				
				<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
				</span>
				{{ config('app.name') }}
			</div>
			<!-- end invoice-company -->
			<!-- begin invoice-header -->
			<div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">{{ config('app.name') }}.</strong><br />
						
					</address>
				</div>
				<div class="invoice-to">
					<small>to</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">{{$getPackage->users->first_name}} {{$getPackage->users->last_name}}</strong><br />
						{{$getPackage->users->email}}<br />
						Phone: {{$getPackage->users->phone}}<br />
					</address>
				</div>
				<div class="invoice-date">
					<small>Invoice</small>
					<div class="date text-inverse m-t-5">{{$getPackage->created_at}}</div>
					<div class="invoice-detail">
						#{{$getPackage->start_date}}_{{$getPackage->id}}<br />
						
					</div>
				</div>
			</div>
			<!-- end invoice-header -->
			<!-- begin invoice-content -->
			<div class="invoice-content">
				<!-- begin table-responsive -->
				<div class="table-responsive">
					<table class="table table-invoice">
						<thead>
							<tr>
								<th>Package DESCRIPTION</th>
								<th class="text-center" width="10%">Twitter account</th>
								<th class="text-center" width="10%">Start date</th>
								<th class="text-center" width="10%">End date</th>
								<th class="text-right" width="20%">Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="text-inverse">{{$getPackage->plan_package->name}}</span><br />
									<small>{{$getPackage->plan_package->description}}</small>
								</td>
								<td class="text-center">{{$getPackage->account_id}}</td>
								<td class="text-center">{{$getPackage->start_date}}</td>
								<td class="text-center">{{$getPackage->end_date}}</td>
								<td class="text-right">${{$getPackage->plan_package->monthly_price}}</td>
							</tr>
							
							
						</tbody>
					</table>
				</div>
				<!-- end table-responsive -->
				<!-- begin invoice-price -->
				<div class="invoice-price">
					<div class="invoice-price-left">
						<div class="invoice-price-row">
							{{-- <div class="sub-price">
								<small>SUBTOTAL</small>
								<span class="text-inverse">$4,500.00</span>
							</div>
							<div class="sub-price">
								<i class="fa fa-plus text-muted"></i>
							</div>
							<div class="sub-price">
								<small>PAYPAL FEE (5.4%)</small>
								<span class="text-inverse">$108.00</span>
							</div> --}}
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> <span class="f-w-600">${{$getPackage->plan_package->monthly_price}}.00</span>
					</div>
				</div>
				<!-- end invoice-price -->
			</div>
			<!-- end invoice-content -->
			<!-- begin invoice-note -->
			<div class="invoice-note">
				* as per company policy
			</div>
			<!-- end invoice-note -->
			<!-- begin invoice-footer -->
			<div class="invoice-footer">
				<p class="text-center m-b-5 f-w-600">
					THANK YOU
				</p>
				<p class="text-center">
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> rtiemps@gmail.com</span>
				</p>
			</div>
			<!-- end invoice-footer -->
		</div>
		<!-- end invoice -->
	</div>
	<!-- end #content -->

@endsection