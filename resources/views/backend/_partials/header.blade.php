<!-- begin #header -->
      <div id="header" class="header navbar-default">
          <!-- begin navbar-header -->
          <div class="navbar-header">
              <a class="navbar-brand"><img src="{{asset('public/img/logo.png')}}" class="img-responsive" alt="{{ config('app.name') }}"> </a>
              <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="sidebar-scroll-bg hidden-xs hidden-sm" style="display: inline">
                <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fas fa-bars"></i></a>
              </div>
          </div>
          <!-- end navbar-header -->
          
          <!-- begin header-nav -->
          <ul class="navbar-nav navbar-right">
              <!-- <li>
                  <form class="navbar-form">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Enter keyword" />
                          <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                      </div>
                  </form>
              </li>
              <li class="dropdown">
                  <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                      <i class="fa fa-bell"></i>
                      <span class="label">5</span>
                  </a>
                  <ul class="dropdown-menu media-list dropdown-menu-right">
                      <li class="dropdown-header">NOTIFICATIONS (5)</li>
                      <li class="media">
                          <a href="javascript:;">
                              <div class="media-left">
                                  <i class="fa fa-bug media-object bg-silver-darker"></i>
                              </div>
                              <div class="media-body">
                                  <h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
                                  <div class="text-muted f-s-11">3 minutes ago</div>
                              </div>
                          </a>
                      </li>
                      <li class="media">
                          <a href="javascript:;">
                              <div class="media-left">
                                  
                                  <i class="fab fa-facebook-messenger text-primary media-object-icon"></i>
                              </div>
                              <div class="media-body">
                                  <h6 class="media-heading">John Smith</h6>
                                  <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                  <div class="text-muted f-s-11">25 minutes ago</div>
                              </div>
                          </a>
                      </li>
                      <li class="media">
                          <a href="javascript:;">
                              <div class="media-left">
                                  
                                  <i class="fab fa-facebook-messenger text-primary media-object-icon"></i>
                              </div>
                              <div class="media-body">
                                  <h6 class="media-heading">Olivia</h6>
                                  <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                  <div class="text-muted f-s-11">35 minutes ago</div>
                              </div>
                          </a>
                      </li>
                      <li class="media">
                          <a href="javascript:;">
                              <div class="media-left">
                                  <i class="fa fa-plus media-object bg-silver-darker"></i>
                              </div>
                              <div class="media-body">
                                  <h6 class="media-heading"> New User Registered</h6>
                                  <div class="text-muted f-s-11">1 hour ago</div>
                              </div>
                          </a>
                      </li>
                      <li class="media">
                          <a href="javascript:;">
                              <div class="media-left">
                                  <i class="fa fa-envelope media-object bg-silver-darker"></i>
                                  <i class="fab fa-google text-warning media-object-icon f-s-14"></i>
                              </div>
                              <div class="media-body">
                                  <h6 class="media-heading"> New Email From John</h6>
                                  <div class="text-muted f-s-11">2 hour ago</div>
                              </div>
                          </a>
                      </li>
                      <li class="dropdown-footer text-center">
                          <a href="javascript:;">View more</a>
                      </li>
                  </ul>
              </li> -->
              <li class="dropdown navbar-user">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{asset('public/img/user.jpg')}}" alt="" /> 
                      <span class="d-none d-md-inline">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</span> <b class="caret"></b>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a>
                      <a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
                      <a href="javascript:;" class="dropdown-item">Calendar</a>
                      <a href="javascript:;" class="dropdown-item">Setting</a> -->
                      
                      <a href="{{URL::to('/')}}" class="dropdown-item">Home page</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                                  
                  </div>
              </li>
          </ul>
          <!-- end header navigation right -->
      </div>
      <!-- end #header -->