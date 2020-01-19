@push('css')
<style>
    .user-sec {color: #fff; outline: none; cursor: pointer;}
    .user-sec a{color: #fff; outline: none; cursor: pointer;}
</style>
@endpush
<?php 
    if(Session::has('instagramInfo')){
        $instagramInfo = Session::get('instagramInfo');
        $name = $instagramInfo->username;
        $avater = $instagramInfo->profile_picture;
    }else{
        $name = '';
        $avater =  '';
    }
 ?>
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        @if(Request::path() != 'dashboard')
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{$avater}}" alt="{{$name}}" />
                    </div>
                    <div class="info user-sec textWhite">
                        {{$name}} <br> <a href="{{URL::to('logout/instagram')}}" class="btn btn-danger" style="padding: 0px 6px;">logout</a>
                    </div>
                </a>
            </li>
            
        </ul>
        @endif
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            
            <li class="has-sub {{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{URL::to('/dashboard')}}"><i class="fa fa-th-large"></i> <span> <span>Dashboard</span></span></a></li>
            <li class="has-sub {{ Request::is('twitter-dashboard') ? 'active' : '' }}"><a href="{{URL::to('/twitter-dashboard')}}"><i class="fab fa-twitter"></i> <span> <span>Twitter Dashboard</span></span></a></li>
            
            <li class="has-sub {{ Request::is('instagram-dashboard') ? 'active' : '' }}"><a href="{{URL::to('/instagram-dashboard')}}"><i class="fab fa-instagram"></i> <span> <span>Instagram Dashboard</span></span></a></li>
            @if(Request::path() != 'dashboard' && Request::path() != 'instagram-setup')
            @include('backend._partials.instagram_menu')
            @endif
            <li class="has-sub {{ Request::is('view-profile') ? 'active' : '' }}"><a href="{{URL::to('/view-profile')}}"><i class="fa fa-user"></i> <span> <span>My profile</span></span></a></li>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
            
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>