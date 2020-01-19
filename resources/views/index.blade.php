@extends('layouts.app')
@push('css')
<!--  -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600|Pacifico">
<link rel="stylesheet" href="{{asset('public/css/extra-style.css')}}">
@endpush
@section('title', 'Home')
@section('content')
    <div class="tweet-mainpage pt0">
        <section class="tweet-section tweet-banner">
            <div class="banner-text">
                <div class="text">
                    <div class="middel">
                        <div class="box">
                            <div class="heading">
                                <h3> Twitter & Instagram management Tool</h3>
                            </div>
                            <p class="sub-title">Engage Leads. Gain Followers. Promote Your Business.</p>
                            <div class="margin-auto">
                                <a href="{{URL::to('/register')}}" class="btn btn-default"> Start your free trial!</a>
                            </div>
                            <span class="no-card">no credit card needed</span>
                            <!-- <img src="{{asset('public/img/border-line.png')}}" alt=""> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="tweet-followers hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="follower-box pull-right">
                                <h1 class="count">
                                    42,300,000
                                </h1>
                                <p class="text">
                                    Leads Engaged
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="follower-box pull-left">
                                <h1 class="count">
                                    18,700,000
                                </h1>
                                <p class="text">
                                    Followers Gained
                                </p>
                            </div>
                        </div>
            
            
                    </div>
                </div>
            </div> -->
        </section>
     <!-- <div class="tweet-section tweet-followers visible-xs hidden-lg hidden-md hidden-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="follower-box pull-right">
                            <h1 class="count">
                                42,300,000
                            </h1>
                            <p class="text">
                                Leads Engaged
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="follower-box pull-left">
                            <h1 class="count">
                                18,700,000
                            </h1>
                            <p class="text">
                                Followers Gained
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div> -->
        <section id="intro" class="unpad">
            <div class="container">
                <div class="row text-center mt--2">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2 class="h1"><span class="text--logo light color--primary">Upleap</span> makes getting followers simple</h2>
                        <p class="lead"> Upleap connects you with a dedicated account manager, who engages with people on Instagram. Grow your likes, followers, and social exposure. </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="space--xs mt--xs--1">
            <div class="container">
                <div class="row mt--3 text-center">
                    <div class="col-sm-3">
                        <div class="text-block"> <i class="fas fa-angle-double-right icon icon-Next2 circled one"></i>
                            <h4>Easy Setup</h4>
                            <p>Sign up &amp; follow a few very simple instructions to get started in minutes.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-block"> <i class="fas fa-chart-bar icon icon-Bar-Chart3 circled two"></i>
                            <h4>Get More Followers</h4>
                            <p> Your account picks up real, organic followers faster that engage with your content. </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-block"> <i class="fas fa-bolt icon icon-Flash circled three"></i>
                            <h4>Social Influence</h4>
                            <p>Upleap customers experience up to 300% faster growth on Instagram. </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-block"> <i class="fas fa-user-check icon icon-Checked-User circled four"></i>
                            <h4>Real Results</h4>
                            <p>We only engage with real accounts based on your targeted audience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class="tweet-section tweet-howwork">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <div class="how-work-text find-customers">
                            <h3 class="color-2">Find Potential Customers</h3>
                            <p>Tell us about the keywords, #Hashtags and phrases common to your industry. Our Artificial Intelligence based engine will then find potential customers who are looking for products and services just like yours.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="how-work-img">
                            <div class="left-customers-box">
                                <div class="height-line"></div>
                                <div class="width-line"></div>
                                <div class="round"></div>
                            </div>
        
                            <img src="{{asset('public/img/howtowork.jpg')}}" class="img-responsive" alt="">
                            <div class="right-targets-box">
                                <div class="height-line"></div>
                                <div class="width-line"></div>
                                <div class="width-line-2"></div>
                                <div class="round"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="how-work-text engage-targets">
                            <h3 class="color-1">Engage your targets</h3>
                            <p>We will engage your potential customers by auto liking and auto ReTweeting their Tweets using YOUR Twitter account. We can even automatically follow these potential customers on your behalf.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="win-business-img">
                            <img src="{{asset('public/img/win-business.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="how-work-text win-business">
                            <h3 class="color-3">Win More Business</h3>
                            <p>When Tweetstatus engages customers on your behalf they will, out of curiosity, come to check out your brand or website and you can convert them easily. It is all automated without your intervention.</p>
                            <a href="{{URL::to('/register')}}" class="btn btn-default"> Start your free trial today!</a>
                        </div>
                    </div>
                </div>
        
            </div>
        </section> -->
        <!-- <section class="tweet-section tweet-testimonials">
            <div class="row">
                <div class=" col-lg-2"> </div>
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class=" col-md-3 col-sm-12 col-xs-12">
                            <div class="heading">
                                <h1 class="title"> <span>Tweetstatus</span> is trusted by over <span>40,000</span> businesses</h1>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/fighto/status/512266620325347328">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/paulshapiro.jpg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>Paul Shapiro</h3>
                                        <p>@fighto</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Check out Tweetstatus http://tweetstatus.com/ - it's a pretty sweet way to automate interactions on Twitter based on sentiment</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/jon_tavarez/status/571482882734206978">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/jontavarez.jpg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>Jonathan Tavarez</h3>
                                        <p>@jon_tavarez</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Looking for the ideal twitter marketing tool? Check out Tweetstatus. It's badass and best of all, hands off! @tweetstatusapp</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/blindapeseo/status/572344945463451648">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/thesimiansensei.jpeg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>The Simian Sensei</h3>
                                        <p>@blindapeseo</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Don't forget about tweetstatus. Still the best automated twitter marketing tool out there. http://blindapeseo.com/marketing-2/tweetstatus-gets-even-better …</p>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="col-md-1"></div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/ThinkDope/status/566627983788486656">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/lifetimesaasdeals.jpg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>Lifetime SaaS Deals</h3>
                                        <p>@lifetimeSaaS</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Tweetstatus: How I Gained 1000 Real Twitter Followers in a Month http://tkdo.us/1BN6lyL</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/foodieduud/status/603098144637734913">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/foodiedude.jpeg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>Foodie Dude</h3>
                                        <p>@foodieduud</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Suggested a #smallbusiness to start using http://tweetstatus.com/ and their business grew 200% literally. Highly recommend it to every one.</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-sm-4 col-xs-6">
                            <div class="tweetfull-tweet-box">
                                <div class="twitter-icon">
                                    <a target="_blank" href="https://twitter.com/Nichelle_McCall/status/605547329043587072">
                                       <img src="{{asset('public/img/twitter.png')}}" alt="">
                                   </a>
                                </div>
                                <div class="user-detail">
                                    <div class="user-img">
                                        <img src="{{asset('public/img/nichellemccall.jpeg')}}" alt="">
                                    </div>
                                    <div class="username">
                                        <h3>Nichelle McCall</h3>
                                        <p>@Nichelle_McCall</p>
                                    </div>
                                </div>
                                <div class="tweet">
                                    <p>Find the right audience and provide them value. http://Tweetstatus.com can help you do this too. #mentormonday via @MrMikeStreet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="screenshots-section" id="screenshots">
            <div class="container">
                <!--Sec Title-->
                <div class="sec-title2 text-center mobiletitlemove marginbotdesktop">
                    <h2 class="big-title">Real Twitter Followers</h2>
                    <h3>Targeted Twitter Followers.</h3>
                </div>

                <div class="outer-container clearfix">
                    <!--Carousel Column-->
                    <div class="carousel-column col-md-6 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <div class="mobile-carousel-slider owl-carousel owl-theme owl-loaded">

                                <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(-1023px, 0px, 0px); transition: all 5s linear 0s; width: 5456px;">
                                        <div class="owl-item cloned" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/retail.jpg')}}" alt="Twesocial Retail">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/music.jpg')}}" alt="Twesocial Music">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/animals.jpg')}}" alt="Twesocial Animals">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/beauty.jpg')}}" alt="Twesocial Beauty">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/fitness.jpg')}}" alt="Twesocial Fitness">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/health.jpg')}}" alt="Twesocial Health">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/food.jpg')}}" alt="Twesocial Food">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/lifestyle.jpg')}}" alt="Twesocial Lifestyle">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/fashion.jpg')}}" alt="Twesocial Fashion">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/parenting.jpg')}}" alt="Twesocial Parenting">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/travel.jpg')}}" alt="Twesocial Travel">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/photo.jpg')}}" alt="Twesocial Photo">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/retail.jpg')}}" alt="Twesocial Retail">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/music.jpg')}}" alt="Twesocial Music">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/animals.jpg')}}" alt="Twesocial Animals">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 271px; margin-right: 70px;">
                                            <div class="slide">
                                                <figure class="image">
                                                    <img src="{{asset('public/img/beauty.jpg')}}" alt="Twesocial Beauty">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-controls">
                                    <div class="owl-nav">
                                        <div class="owl-prev" style=""><span class="fa fa-angle-left"></span></div>
                                        <div class="owl-next" style=""><span class="fa fa-angle-right"></span></div>
                                    </div>
                                </div>
                                <div class="owl-dots" style="display: block;">
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot active"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                </div>
                            </div>
                            <!--Mockup Layer-->
                            <div class="mockup-layer"></div>
                        </div>
                    </div>
                    <!--Title Column-->
                    <div class="title-column col-md-6 col-sm-12 col-xs-12 nomob">
                        <div class="inner-column">
                            <h3>Your Interests, Your Followers.</h3>
                            <div class="text">
                                These are a select few demographics we specialize in.</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="cta-section">
            <div class="auto-container">
                <!--Sec Title-->
                <div class="sec-title2 centered">
                    <h3>Getting started is easy.</h3>
                </div>
                <div class="row clearfix">
                    <div class="btns-box" style="text-align:center;">
                        <a href="{{URL::to('/register')}}" class="theme-btn btn-style-four" style="text-align:center;">Get Started Now</a>
                    </div>

                </div>
            </div>
        </section>
        <section class="tweet-section tweet-category tweet-testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="heading">
                            <h1 class="title"> <span>Tweetstatus</span> is for you</h1>
                            <p>Tweetstatus is a tried and tested growth tool by over 40,000 businesses. We have users in almost every country in the world and from every walk of life. If you have customers on Twitter we can help your business grow faster.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="category-box">
                            <div class="category-img">
                                <img src="{{asset('public/img/bloggers.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <h4 class="title">Increase Traffic</h4>
                            <div class="content">
                                <div class="category-name">Bloggers</div>
                                <p>Get your posts shared across social platforms. Let us make your Blog an authority in your industry.
                                </p>
                            </div>
                        </div>
                    </div>
                
                
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="category-box musicians">
                            <div class="category-img">
                                <img src="{{asset('public/img/musicians.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <h4 class="title">Get Recognized</h4>

                            <div class="content">
                                <div class="category-name">Musicians</div>
                                <p>Let the world listen to your newest number and increase your fan following.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="category-box marketers">
                            <div class="category-img">
                                <img src="{{asset('public/img/marketers.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <h4 class="title">Targeted Audience</h4>
                            <div class="content">
                                <div class="category-name">Marketers</div>
                                <p>Leverage tens of filters that Tweetstatus offers to get precisely those people you want. It's easy.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="category-box artists">
                            <div class="category-img">
                                <img src="{{asset('public/img/artists.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <h4 class="title">Be more creative</h4>
                            <div class="content">
                                <div class="category-name">Artists</div>
                                <p>You have perfected your art. Use Tweetstatus to give the world a chance to appreciate it.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="tweet-three-border">
            <div class="border-tweet"></div>
            <div class="border-tweet"></div>
            <div class="border-tweet"></div>
        </section>
        <section class="tweet-section tweet-aboutus">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="aboutus-img">
                            <img src="{{asset('public/img/about-us.png')}}" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="about-content">
                            <h4 class="title">Tweetstatus's AI engine does all the automated likes, automatic ReTweets and auto following thereby saving you a lot of time.</h4>
                            <ul>
                                <li>
                                    <p>Advanced Filtering to only engage real people</p>
                                </li>
                                <li>
                                    <p>AI Supported Sentiment based Tweet filtering</p>
                                </li>
                                <li>
                                    <p>Find and Influence industry influencers</p>
                                </li>
                                <li>
                                    <p>Manage multiple Twitter Accounts</p>
                                </li>
                                <li>
                                    <p>Undo all taken actions to leave No Footprints</p>
                                </li>
                                <li>
                                    <p>Monthly plans, cancel anytime</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <div class="features-box">
                            <div class="features-img">
                                <img src="{{asset('public/img/copy-followers.jpg')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title color-1">Copy Followers </h4>
                                <p>If you want to follow your competitors' followers you can create a "Copy Followers" promotion</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="features-box">
                            <div class="features-img">
                                <img src="{{asset('public/img/engage-tweets.jpg')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title color-2">Engage Tweets by Keywords</h4>
                                <p>Add a new promotion to engage with people who Tweet Keywords and hashtags of your choice.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="features-box">
                            <div class="features-img">
                                <img src="{{asset('public/img/unfollow.jpg')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title color-4">Unfollow </h4>
                                <p>Do you follow a lot of people whom you should not? With Unfollow promotion you can unfollow the unworthy ones. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="tweet-section tweet-trybuy">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6">
                        <div class="trybuy">
                            <h3 class="title">try before you buy!</h3>
                            <p>Everything you need to get more traffic from Twitter. No credit card needed. </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 text-center">
                        <a href="{{URL::to('/register')}}" class="btn btn-default "> Start Your Free Trial Today</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('js')
    
    <script src="{{asset('public/js/extra-jquery.js')}}"></script>
    @endpush
    @endsection