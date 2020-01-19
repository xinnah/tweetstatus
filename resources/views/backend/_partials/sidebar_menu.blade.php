@push('css')
<style>
    .user-sec {color: #fff; outline: none; cursor: pointer;}
    .user-sec a{color: #fff; outline: none; cursor: pointer;}
</style>
@endpush

<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        @if(Auth::user()->role->role_name == 'user' && Session::has('twitterInfo'))
        <?php 
            $twitterInfo = Session::get('twitterInfo');
            $name = $twitterInfo['name'];
            $avater = $twitterInfo['profile_image_url'];
         ?>
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{$avater}}" alt="{{$name}}" />
                    </div>
                    <div class="info user-sec textWhite capitalize">
                        {{$name}} <br> <a href="{{URL::to('logout/twitter')}}" class="btn btn-danger" style="padding: 0px 6px;">logout</a>
                    </div>
                </a>
            </li>
            
        </ul>
        @endif
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <?php
                $url = url()->current();
                $urlEx = explode('/', $url);
                $lastIn = end($urlEx);
                $lastInEx = explode('-', $lastIn);
                
            ?>

            @if($lastInEx[0] != 'twitter')
            <li class="has-sub {{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{URL::to('/dashboard')}}"><i rel="tooltip" data-placement="left" title="Dashboard"  class="fa fa-th-large badge-icon"></i> <span>Dashboard</span> </a></li>
            @endif
        @if(Auth::user()->role->role_name == 'super admin' || Auth::user()->role->role_name == 'admin')

            <li class="has-sub {{ Request::is('role') || Request::is('admin/create') || Request::is('admin') ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i rel="tooltip" data-placement="left" title="Administration" class="fa fa-assistive-listening-systems badge-icon" aria-hidden="true"></i>
                    <span>Administration</span>
                </a>
                <ul class="sub-menu">
                    {{-- <li class="{{ Request::is('role') ? 'active' : '' }}"><a href="{{URL::to('role')}}">Role</a></li> --}}
                    <li class="{{ (Request::path() == 'admin/create') ? 'active' : '' }}"><a href="{{URL::to('admin/create')}}">Add new admin</a></li>
                    <li class="{{ (Request::path() == 'admin') ? 'active' : '' }}"><a href="{{URL::to('admin')}}">Lists of admin</a></li>
                </ul>
            </li>
            
            <li class="has-sub {{ Request::is('plan-package') || Request::is('plan-package/create') ? 'active' : '' }}">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i rel="tooltip" data-placement="left" title="Plan package" class="fas fa-cubes badge-icon"></i>
                    <span>Plan package</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('plan-package/create') ? 'active' : '' }}"><a href="{{URL::to('plan-package/create')}}">create</a></li>
                    <li class="{{ Request::is('plan-package') ? 'active' : '' }}"><a href="{{URL::to('plan-package')}}">Lists of plan package</a></li>
                </ul>
            </li>
            {{-- <li class="has-sub {{ Request::is('services') ? 'active' : '' }}"><a href="{{URL::to('/services')}}"><i rel="tooltip" data-placement="left" title="Services" class="fab fa-servicestack badge-icon"></i><span>Services</span></a></li> --}}
            <li class="has-sub {{ Request::is('faq') ? 'active' : '' }}"><a href="{{URL::to('/faq')}}"><i rel="tooltip" data-placement="left" title="FAQ" class="fas fa-question badge-icon"></i> <span>FAQ</span></a></li>
            <!-- <li ><a href="#"><i rel="tooltip" data-placement="left" title="App about" class="fa fa-th-large badge-icon"></i> <span>App about</span></a></li> -->
            <!-- <li ><a href="#"><i class="fa fa-th-large"></i> <span> <span>User active package</span></span></a></li> -->
            <li class="has-sub {{ Request::is('twitter-users') ? 'active' : '' }}"><a href="{{URL::to('/twitter-users')}}"><i rel="tooltip" data-placement="left" title="List of twitter user" class="fab fa-twitter badge-icon"></i> <span>List of twitter user</span></a></li>

        @elseif(Auth::user()->role->role_name == 'user')

            <li class="has-sub {{ Request::is('twitter-dashboard') ? 'active' : '' }}"><a href="{{URL::to('/twitter-dashboard')}}"><i rel="tooltip" data-placement="left" title="Twitter Dashboard" class="fab fa-twitter badge-icon"></i><span>Twitter Dashboard</span></a></li>

            @if($lastInEx[0] == 'twitter')
            
                @if(Request::path() != 'dashboard' && Request::path() != 'twitter-setup' && Request::path() != 'twitter-update')
                    @if(isset($premium) && $premium == true)
                    <li class="has-sub {{ Request::is('twitter-settings') ? 'active' : '' }}"><a href="{{URL::to('/twitter-settings')}}"><i rel="tooltip" data-placement="left" title="Twitter Settings" class="fas fa-cogs badge-icon"></i><span>Twitter Settings</span>  
                    @else
                    @include('backend._partials.twitter_menu')
                    @endif
                @endif

            @endif

            
        @elseif(Auth::user()->role->role_name == 'service')
            <li class="has-sub {{ Request::is('twitter-users') ? 'active' : '' }}"><a href="{{URL::to('/twitter-users')}}"><i rel="tooltip" data-placement="left" title="List of twitter user" class="fab fa-twitter badge-icon"></i><span>List of twitter user</span></a></li>
            @if(Session::has('twitterInfo'))
                <li class="has-sub {{ Request::is('twitter-keyword-wise/follow') ? 'active' : '' }}"><a href="{{URL::to('/twitter-keyword-wise/follow')}}"><i rel="tooltip" data-placement="left" title="Keyword wise follow" class="fa fa-users badge-icon"></i> <span>Keyword wise follow</span></a></li>
                <li class="has-sub {{ Request::is('twitter-keyword-wise/unfollow') ? 'active' : '' }}"><a href="{{URL::to('/twitter-keyword-wise/unfollow')}}"><i rel="tooltip" data-placement="left" title="Keyword wise unfollow" class="fas fa-user-times badge-icon"></i> <span>Keyword wise unfollow</span></a></li>

                <!-- <li class="has-sub {{ Request::is('twitter-keyword-wise/retweet') ? 'active' : '' }}"><a href="{{URL::to('/twitter-keyword-wise/retweet')}}"><i rel="tooltip" data-placement="left" title="Keyword wise retweet" class="fa fa-retweet badge-icon"></i> <span>Keyword wise retweet</span></a></li>
                <li class="has-sub {{ Request::is('twitter-keyword-wise/tweet-like') ? 'active' : '' }}"><a href="{{URL::to('/twitter-keyword-wise/tweet-like')}}"><i rel="tooltip" data-placement="left" title="Keyword wise like" class="fas fa-heart badge-icon"></i> <span>Keyword wise tweet like</span></a></li>
                <li class="has-sub {{ Request::is('twitter-keyword-wise/tweet-unlike') ? 'active' : '' }}"><a href="{{URL::to('/twitter-keyword-wise/tweet-unlike')}}"><i rel="tooltip" data-placement="left" title="Keyword wise unlike" class="fas fa-heart badge-icon"></i> <span>Keyword wise tweet unlike</span></a></li> -->
            @endif
            
            <!-- <li class="has-sub {{ Request::is('instagram-users') ? 'active' : '' }}"><a href="{{URL::to('/instagram-users')}}"><i class="fab fa-instagram"></i> <span> <span>List of instagram user</span></span></a></li> -->
        @endif
            
            <li class="has-sub {{ Request::is('account-settings') ? 'active' : '' }}"><a href="{{URL::to('/account-settings')}}"><i rel="tooltip" data-placement="left" title="My profile" class="fa fa-cog badge-icon"></i> <span>Account settings</span></a></li>

            <li class="has-sub {{ Request::is('view-profile') || Request::is('edit-profile') || Request::is('change-password') ? 'active' : '' }}"><a href="{{URL::to('/view-profile')}}"><i rel="tooltip" data-placement="left" title="My profile" class="fa fa-user badge-icon"></i> <span>My profile</span></a></li>

            <li class="has-sub logout-nav-btn">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i rel="tooltip" data-placement="left" title="Logout" class="fas fa-power-off badge-icon"></i> <span>Logout</span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>    
            </li>
            <!-- begin sidebar minify button -->
            <!-- <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li> -->
            <li class="navside-footer hidden-sm hidd-xs">
                <button class="btn btn-navbtn btn-sm"><a href="{{URL::to('/view-profile')}}"><i rel="tooltip" data-placement="Top" title="My profile" class="fa fa-user badge-icon"></i></a></button>
                <button class="btn btn-navbtn btn-sm"><a href="javascript:;" id="btnFullscreen"><i rel="tooltip" data-placement="top" title="Fullscreen" class="fas fa-desktop"></i></a></button>
                <button class="btn btn-navbtn btn-sm"><a href="javascript:;"><i rel="tooltip" data-placement="top" title="Re-synchronize Data" class="fas fa-sync-alt"></i></a></button>
                <button class="btn btn-navbtn btn-sm"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i rel="tooltip" data-placement="top" title="Logout" class="fas fa-power-off"></i></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form></button>
                
            </li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>