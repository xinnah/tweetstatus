<header class="{{ Request::is('/')?'':'secound-header' }}">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <div class="logo">
                    <a class="navbar-brand" href="{{URL::to('/')}}">
                        <img src="{{asset('public/img/logo.png')}}" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <nav class="navbar">
                    <div class="navbar-header">
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav ">
                            <li><a class=" active" href="{{URL::to('/')}}">Home </a></li>
                            <li><a class="" href="{{URL::to('/plan')}}">Pricing</a></li>
                            <!-- <li><a class="" href="#">Contact</a></li> -->

                            @if(Auth::check())
                            <li class="visible-xs hidden-lg hidden-md hidden-sm"><a href="{{URL::to('/dashboard')}}"> Dashboard</a></li>
                            <li class="visible-xs hidden-lg hidden-md hidden-sm"> 
                                <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                            </li>
                            @else
                            <li class="visible-xs hidden-lg hidden-md hidden-sm"><a href="{{URL::to('login')}}"> Log in</a></li>
                            <li class="visible-xs hidden-lg hidden-md hidden-sm"> <a href="{{URL::to('register')}}"> Sign Up Free</a></li>
                            @endif
                        </ul>
                        
                    </div>
                </nav>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <ul class="action-btn navbar-right hidden-xs">
                    @if(Auth::check())
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle btn btn-info login" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->first_name}} {{Auth::user()->last_name}} <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li> 
                            <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }} </form>
                        </li>
                      </ul>
                    </li>
                    @else
                    <li><a href="{{URL::to('login')}}" class="btn btn-info login"> Log in</a></li>
                    <li> <a href="{{URL::to('register')}}" class="btn btn-info signup"> Sign Up Free</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>