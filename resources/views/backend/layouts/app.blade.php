<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - @yield('title')   </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('public/img/favicon.png')}}">
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    
    <link href="{{asset('public/assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/plugins/font-awesome/5.3/css/all.min.css')}}" rel="stylesheet" />
    
    <link href="{{asset('public/assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/default/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/default/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    @stack('css')
    <link rel="stylesheet" href="{{asset('public/assets/css/custom.css')}}">
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/assets/plugins/pace/pace.min.js')}}"></script>
    
    
    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <div id="app">
            <input type="hidden" value="{{URL::to('/')}}" id="base_url">
            <!-- begin #header -->
            
            @include('backend._partials.header')
            @include('notify.alert-notify')
            
            <!-- begin #sidebar -->
            @include('backend._partials.sidebar_menu')
            <!-- end sidebar -->
            
            <!-- begin main content section -->
            @yield('content')

            {{-- update data  --}}
            <div class="modal fade" id="update-synco-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header modal-info">
                    <h5 class="modal-title" id="exampleModalLabel">Synchronizing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                  </div>
                  <div class="modal-body">
                   <div id="sncy-data"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="update-btn-a" href="{{URL::to('/twitter-update')}}" class="btn btn-success" style="display: none;">Yes, Update!</a>
                  </div>
                </div>
              </div>
            </div>
            @include('backend._partials.footer')
        </div>
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    
    <script src="{{asset('public/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('public/assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('public/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('public/assets/js/theme/default.min.js')}}"></script>
    <script src="{{asset('public/assets/js/apps.min.js')}}"></script>
    
    <!-- ================== END BASE JS ================== -->
    @stack('js')
   <script src="{{asset('public/assets/js/custom.js')}}"></script>
</body>
</html>