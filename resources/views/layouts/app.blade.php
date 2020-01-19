<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title') </title>
    <meta name="keywords" content="{{ config('app.name') }}, unfollowers, who unfollowed me, who unfollowed me on twitter, who unfollowed you, twitter unfollowers, unfollowers, unfollowers.net, who.unfollowed.me, twitter follow unfollow utility, twitter unfollow tools, twitter unfollow unfollowers" />
    <meta name="description" content="{{ config('app.name') }} :: This is a free to use third party twitter app to track unfollowers & unfollow them. Who unfollowed me on twitter!" />
    <meta name="author" content="{{URL::to('/')}}" />

    
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property='og:title' content='{{ config('app.name') }} :: Track and unfollow your unfollowers!' />
    <meta property='og:url' content='{{URL::to("/")}}' />
    <meta property='og:locale' content='en_US' />
    <meta property="og:description" content="{{ config('app.name') }} is a free third party twitter app to track followers/{{ config('app.name') }}. Find out who unfollowed me on twitter!"/>
    <meta property="og:image" content="{{asset('public/img/site-share.png')}}"/>
    <link rel="image_src" href="{{asset('public/img/site-share.png')}}" />
    
    <!--Facebook ogp-->
    <meta name="og:site_name" content="{{ config('app.name') }}" />
    <meta name="og:title" content="{{ config('app.name') }} :: Track and unfollow your unfollowers!" />
    <meta property="og:description" content="{{ config('app.name') }} is a free third party twitter app to track followers/{{ config('app.name') }}. Find out who unfollowed me on twitter!">
    <meta name="og:image" content="{{asset('public/img/site-share.png')}}" />
    <meta name="og:url" content="{{URL::to('/')}}" />
    <meta property="article:publisher" content="https://www.facebook.com/{{ config('app.name') }}" />
    <meta property="article:author" content="https://www.facebook.com/{{ config('app.name') }}" />
    <!--Facebook ogp end-->
    
    <!--Twitter Meta Tags-->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@ {{ config('app.name') }}" />
    <meta name="twitter:url" content="{{URL::to('/')}}" />
    <meta name="twitter:title" content="{{ config('app.name') }} :: Track and unfollow your {{ config('app.name') }}s!" />
    <meta name="twitter:description" content="{{ config('app.name') }} is a free third party twitter app to track followers/{{ config('app.name') }}. Find out who unfollowed me on twitter!">
    <meta name="twitter:image:src" content="{{asset('public/img/site-share.png')}}" />
    <!--Twitter Meta Tags END-->    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link rel="icon" href="{{asset('public/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,600,700,800,900" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    
    <link href="{{asset('public/assets/plugins/font-awesome/5.3/css/all.min.css')}}" rel="stylesheet" />

    <link href="{{asset('public/css/sweetalert.css')}}" rel="stylesheet" type="text/css">
    @stack('css')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{asset('public/css/main-style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/css/super-style.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/js/slick/slick.css')}}" />
    <link href="{{asset('public/js/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('public/js/jquery-1.11.0.js')}}"></script>
    <script src="{{asset('public/js/sweetalert.min.js')}}"></script>
    
    

</head>
<body id="page-top" class="index" >
    <div id="app-section">
        <input type="hidden" id="base_url" value="{{URL::to('/')}}">
        @include('_partials.header')
        @include('notify.alert-notify')
        @yield('content')
        
        @include('_partials.footer')
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll visible-xs visble-sm">
            <a class="btn btn-primary" href="{{URL::to('/')}}#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> -->
    
    <script src="{{asset('public/assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/js/usermailget.js')}}"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    @stack('js')
    <script src="https://platform.twitter.com/widgets.js"></script>
    
    
    <!-- Scripts -->
</body>
</html>
