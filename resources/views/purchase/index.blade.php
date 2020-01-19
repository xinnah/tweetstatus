@extends('layouts.app')
@push('css')
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
@endpush
@section('title', 'Plan')
@section('content')

<div class="tweet-mainpage" id="app">
  <section class=" tweet-section tweet-login">
    <div class="container">
      <div class="row">
        <div class="check-out-section">
          <div class="col-md-8">
            <front-checkout :plan="{{json_encode($getPlan)}}" :user="{{json_encode($auth_user)}}"></front-checkout>
            
          </div>
        </div>

        <div class="col-md-4 plans">
            <div class="heading">
                <h1 class="title">Your Selected Plan</h1>
                </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $getPlan->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="row">
                            <h2 class="plans-price">
                                <sup>$</sup>{{ $getPlan->monthly_price }}<sub class="h5">/mo</sub>
                            </h2>
                        </div>
                    </div>
                    <div class="plans-desc">
                      <p>{{ $getPlan->following }} follow</p>
                      <p>{{ $getPlan->unfollowing }} Unfollow</p>
                      <p>{{ $getPlan->block }} Block</p>
                      <p>{{ $getPlan->mute }} Mute</p>
                      <p>@if($getPlan->plan_category == 1) 0 @else unlimited @endif Whitelist/Blacklist</p>
                      <p>Ads @if($getPlan->plan_category == 1) Yes @else No @endif </p>
                      <p>Sync Interval @if($getPlan->plan_category == 1) 12 Hours @else 4 Hours @endif </p>
                      <p>@if($getPlan->plan_category == 1) Basic Support @else Premium Support @endif </p>
                    </div>
                    <!--<div class="my-md-gutter"></div>-->
                </div>
            </div>

            <div class="my-lg-gutter"></div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('js')
<script src="{{asset('public/js/app.js')}}"></script> 
@endpush
@endsection
