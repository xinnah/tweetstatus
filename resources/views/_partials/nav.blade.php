
    <!-- HEADER -->
    <header>
        <div class="container">
            <div id="logo-wrapper">
                <div class="cell-view"><a id="logo" href="{{URL::to('/')}}"><img src="{{asset('public/img/company-logo.png')}}" alt="" /></a></div>
            </div>
            <div class="open-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header-container">
                <div class="scrollable-container">
                    <div class="header-left">
                        <nav>
                            
                            <div class="menu-entry">
                                <a href="{{URL::to('/')}}">Home</a>
                            </div>
                            @if(Request::path() == 'register' || Request::path() == 'login')
                            
                            @else
                            <div class="menu-entry">
                                <a class="scroll-to-link subheader-link" data-rel="1">Our Services</a>
                            </div>
                            <div class="menu-entry">
                                <a class="scroll-to-link subheader-link" data-rel="2">Popular Plans</a>
                            </div>
                            <div class="menu-entry">
                                <a class="scroll-to-link subheader-link" data-rel="3">Why Choose Us</a>
                            </div>
                            <div class="menu-entry">
                                <a class="scroll-to-link subheader-link" data-rel="4">Latest News</a>
                            </div>
                            <div class="menu-entry">
                                <a class="scroll-to-link subheader-link" data-rel="5">Testimonials</a>
                            </div>
                            @endif
                            <div class="menu-entry">
                                <a href="#">Contact us</a>
                            </div>
                            <?php 
                              if(Session::has('twitterInfo')){
                                ?>
                                <div class="menu-entry">
                                    <a href="{{URL::to('/logout/twitter')}}">Twitter logout</a>
                                </div>
                                <?php
                              }
                               
                            ?>
                                                                                
                        </nav>
                    </div>

                    <div class="header-right">
                        <div class="header-inline-entry">
                            <div><i class="fas fa-clock"></i><b> 24/7</b> Custtomer Support </div>
                            <div><i class="fas fa-phone"></i> <a href="#" class="telephone-link">+8801968800060</a></div>
                        </div>
                        <div class="header-inline-entry">
                            <a class="button" href="{{URL::to('login')}}">login</a>
                        </div>
                        <div class="header-inline-entry">
                            <a class="link" href="{{URL::to('register')}}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- <div class="subheader">
        <div class="container-fluid">
            <a id="subheader-logo" href="index-2.html"><img src="{{asset('public/img/logo.png')}}" alt="" /></a>
            <div class="subheader-content">
                <div class="subheader-left">
                    <a class="scroll-to-link subheader-link" data-rel="1">Our Services</a>
                    <a class="scroll-to-link subheader-link" data-rel="2">Popular Plans</a>
                    <a class="scroll-to-link subheader-link" data-rel="3">Why Choose Us</a>
                    <a class="scroll-to-link subheader-link" data-rel="4">Latest News</a>
                    <a class="scroll-to-link subheader-link" data-rel="5">Testimonials</a>
                </div>
                <div class="subheader-right">
                    <a class="button">Get Started</a>  
                </div>
            </div>
        </div>
    </div> -->