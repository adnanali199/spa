<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="home" content="{{route('/')}}">

<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700|Arimo:400,700|Playfair+Display:400,400i,700|Cookie" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/dark.css')}}" type="text/css" />

<link rel="stylesheet" href="{{asset('frontend/demos/spa/spa.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/demos/spa/css/fonts/spa-icons.css')}}" type="text/css" />

<link rel="stylesheet" href="{{asset('frontend/css/font-icons.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/demos/spa/css/fonts.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="{{asset('frontend/css/colors3dda.css?color=78c9d1')}}" type="text/css" />
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/include/rs-plugin/css/settings.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/include/rs-plugin/css/layers.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/include/rs-plugin/css/navigation.css')}}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet" />
<link href="{{asset('frontend/css/searchbar.css')}}" rel="stylesheet" /> 
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
<!--http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css-->
<link rel="stylesheet" href="{{asset('css/slick.min.css')}}" />
<!--https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css-->
<style>
    .ui-widget-content {
    border: 1px solid #dddddd;
    background: #000000!important;
    color: #ec1414!important;
}
.radio{
    height:17px;
    width:17px;
}
    .login-page{
        width:40%;
        margin:0px auto;
    }
    @media screen and (max-width:960px)
    {
        .login-page{
        width:100%;
        margin:0px auto;
    }
    }
    .slick-dots{
            text-align: center;
        }
     .slick-dots li {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
}
.slick-dots li button {
    font-size: 0;
    line-height: 0;
    display: block;
    width: 20px;
    height: 20px;
    padding: 5px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
}
.slick-dots li button:before {
    content: '•';
    font-size: 32px;
    line-height: 20px;
    position: absolute;
    top: 0;
    left: 0;
    width: 20px;
    height: 20px;
    text-align: center;
    opacity: .25;
    color: black;
}
    </style>
@yield('styles')
    <style>

		.tp-caption.Fashion-SmallText, .Fashion-SmallText,
		.tp-caption.Fashion-TextBlock, .Fashion-TextBlock {
			font-family: 'Lato';
			color: #FFF;
		}

		.tp-caption.Fashion-BigDisplay, .Fashion-BigDisplay {
			font-family: 'Cookie';
			letter-spacing: 1px;
			font-weight: 700;
			color: #FFF;
			text-transform: capitalize;
		}

		.restaurant-reviews .flex-control-nav {
			top: auto;
			bottom: 25px;
		}
        #right{
            display:none;
        }
        @media screen and (max-width:767px)
        {
            #right{
                display:block;
            }
            #primary-menu{
                position: absolute;
                background: #333;
                
                top:100px;
                left: 0px;
                width: 100%;
            }
            #primary-menu ul{
                padding:10px!important;
            }
        }
	</style>
</head>
<?php $settings = App\Models\Settings::find(1); ?>
<body class="stretched" data-loader-color="#103e4d">
<div class="wrapper" id="wrapper" class="clearfix">

    <!-- Navbar -->
    <header id="header" class="no-sticky transparent-header dark bg-dark" data-responsive-class="dark">
        <div id="header-wrap">
        <div class="container clearfix">
        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
        
        <div id="logo">
        <a href="{{route('/')}}" class="standard-logo"><img src="{{ asset('frontend/demos/spa/images/logo.png')}}" alt="Canvas Logo"></a>
        <a href="{{route('/')}}" class="retina-logo"><img src="{{ asset('frontend/demos/spa/images/logo.png')}}" alt="Canvas Logo"></a>
        </div>
        <div id="right" style="position:absolute;right:20px;top:40px;z-index:100000000001">
            @if (Route::has('login'))
        
            @auth
            <div class=" dropdown">  
           
              <a class=""  style="color:#FFF;font-weight:bolder" data-toggle="dropdown" href="#" aria-expanded="false">
                  {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu " style="left: inherit; right: 0px;min-width:200px;">
                
                  <a href="#" class="dropdown-item" onclick="startFCM()">
                    <i class="mr-2 fas fa-bell"></i>
                    {{ __('Enable Notification') }}
                </a>
                <div class="dropdown-divider"></div>
                @if(Auth::user()->userType->type=="owner")
                <a href="{{route('owner.home')}}" class="dropdown-item" >
                    <i class="mr-2 fas fa-home"></i>
                    {{ __('Dashboard') }}
                </a>
                <div class="dropdown-divider"></div>
                @endif
                @if(Auth::user()->userType->type=="admin")
                <a href="{{route('admin.home')}}" class="dropdown-item" >
                    <i class="mr-2 fas fa-home"></i>
                    {{ __('Dashboard') }}
                </a>
                <div class="dropdown-divider"></div>
                @endif
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="#" class="dropdown-item"
                         onclick="event.preventDefault(); this.closest('form').submit();">
                          <i class="mr-2 fas fa-sign-out-alt"></i>
                          {{ __('Log Out') }}
                      </a>
                  </form>

              </div>
         
      
            </div>
                @else
                
                      <a class="" style="color:#FFF;font-weight:bolder" href="{{route('login')}}" aria-expanded="false">
                          Login
                      </a>
                      

              
            @endauth
            @endif
        </div>
        
        <nav id="primary-menu" class="not-dark " >
        <ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1250" data-offset="0">
        <li class="current"><a href="{{route('/')}}" ><div>Home</div></a></li>
        <li><a href="{{route('/')}}#pools" data-href="{{route('/')}}"><div>Pools</div></a></li>
        <li><a href="{{route('bookings')}}" ><div>{{ __('MY Bookings') }}</div></a></li>
        <li class=" dropdown">  
            <!-- Right navbar links -->
        
         
              <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                  {{ __('Language') }}
              </a>
              <div class="dropdown-menu " style="left: inherit; right: 0px;">
                
                    <a href="{{ route('locale', ['locale' => 'en']) }}"  class="dropdown-item btn btn-primary {{ Session::get('locale') == 'en' ? 'active' : ''}}">{{ __("English")}}</a>
                    <a href="{{ route('locale', ['locale' => 'fr']) }}"  class="dropdown-item btn btn-primary {{ Session::get('locale') == 'fr' ? 'active' : ''}}">{{ __("Arabic")}}</a>
                <div class="dropdown-divider"></div>
                 

              </div>
         
      
            </li>
            @php
            $cartcount = \Session::get('cart');

            @endphp
            <li><a href="{{route('pool.checkout')}}" ><i class="fas fa-cart-plus fa-2x" style="font-size: 20px">{{ $cartcount?count($cartcount):0 }} </i></a></li>
        @if (Route::has('login'))
        
            @auth
            
            <li class=" dropdown">  
            <!-- Right navbar links -->
        
         
              <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                  {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu " style="left: inherit; right: 0px;width:200px">
                 <!-- <a href="{{ route('profile.show') }}" class="dropdown-item">
                      <i class="mr-2 fas fa-file"></i>
                      {{ __('My profile') }}
                  </a>
                  <div class="dropdown-divider"></div>-->
                  <a href="#" class="dropdown-item" onclick="startFCM()">
                    <i class="mr-2 fas fa-bell"></i>
                    {{ __('Enable Notification') }}
                </a>
                <div class="dropdown-divider"></div>
                @if(Auth::user()->userType->type=="owner")
                <a href="{{route('owner.home')}}" class="dropdown-item" >
                    <i class="mr-2 fas fa-home"></i>
                    {{ __('Dashboard') }}
                </a>
                <div class="dropdown-divider"></div>
                @endif
                @if(Auth::user()->userType->type=="admin")
                <a href="{{route('admin.home')}}" class="dropdown-item" >
                    <i class="mr-2 fas fa-home"></i>
                    {{ __('Dashboard') }}
                </a>
                <div class="dropdown-divider"></div>
                @endif
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="#" class="dropdown-item"
                         onclick="event.preventDefault(); this.closest('form').submit();">
                          <i class="mr-2 fas fa-sign-out-alt"></i>
                          {{ __('Log Out') }}
                      </a>
                  </form>

              </div>
         
      
            </li>
                @else
                <li class="">  
                    <!-- Right navbar links -->
                
                 
                      <a class=""  href="{{route('login')}}" aria-expanded="false">
                          Login
                      </a>
                      
                 
              
                    </li>

                @if (Route::has('register'))
                <li class=" dropdown">  
                    <!-- Right navbar links -->
                
                 
                      <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                          Register
                      </a>
                      <div class="dropdown-menu " style="left: inherit; right: 0px;">
                        <a href="{{ route('register') }}" class="dropdown-item ">Customer Register</a>

                          <div class="dropdown-divider"></div>
                          <a href="{{ route('owner.register') }}" class="dropdown-item">Owner Register</a>

                       
                      </div>
                 
              
                    </li>  
                @endif
            @endauth
        
    @endif
        </ul>
        </nav>
        </div>
        </div>
    </header>
    <!-- /.navbar -->

   
    
        <!-- /.slider -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
       
   
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

   
    
    <!-- <footer> -->
    <footer id="footer" class="noborder" style="background-color: #F5F5F5;">

        <div id="copyrights" class="nobg">
        <div class="container clearfix">
        <div class="row">
        <div class="col-lg-3">
        <div class="widget clearfix">
        <div>
        <h5>Headquarters:</h5>
        <address class="nobottommargin">
        <div class="text-muted">
        <p class="nobottommargin"> {{$settings->address}}
        <br></p>
        </div>
        </address>
        </div>
        </div>
        </div>
        <div class="col-lg-3">
        <div class="widget clearfix">
        <div>
        <h5>Contact:</h5>
        <address class="nobottommargin">
        <abbr title="Phone Number"><strong>Phone:</strong>  {{$settings->contact_no}}</abbr> <br>
        <abbr title="Fax"><strong>Fax:</strong>  {{$settings->fax}}</abbr> <br>
        <abbr title="Email Address"><strong>Email:</strong>  {{$settings->email}}</abbr> </a>
        </address>
        </div>
        </div>
        </div>
        <div class="col-lg-6 tright">
        <div class="fright topmargin-sm clearfix">
        <a href="#" class="social-icon si-small si-colored si-facebook">
        <i class="icon-facebook"></i>
        <i class="icon-facebook"></i>
        </a>
        <a href="#" class="social-icon si-small si-colored si-twitter">
        <i class="icon-twitter"></i>
        <i class="icon-twitter"></i>
        </a>
        <a href="#" class="social-icon si-small si-colored si-gplus">
        <i class="icon-gplus"></i>
        <i class="icon-gplus"></i>
        </a>
       
        </div>
        <div class="clear"></div>
        <a target="_blank" href="#">POOL</a>
        </div>
        </div>
        </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
        </footer>
<!--- /footer -->        
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<div id="gotoTop" class="icon-angle-up"></div>

<script src="{{ asset('frontend/js/jquery.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('frontend/js/plugins.js')}}"></script>
<script src="{{ asset('frontend/js/functions.js')}}"></script>

<script src="{{asset('frontend/include/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('frontend/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{ asset('frontend/js/choices.js')}}"></script>
<script src="{{ asset('frontend/js/flatpickr.js')}}"></script>
<script src="{{ asset('js/notify.min.js') }}" ></script>
<!-- https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js -->
<script src="{{ asset('js/slick.js')}}" ></script>
<!-- https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js -->
<script>
    function startSlick()
    {
        
        $('.slider1').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 15,
        slidesToScroll: 15,
        autoplay: false,
        autoplaySpeed: 5000,
        arrows: false,
        
        pauseOnHover:true,
        responsive: [{
          breakpoint: 600,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 6
          }
        },
        {
           breakpoint: 400,
           settings: {
              arrows: false,
              slidesToShow: 6,
              slidesToScroll: 6
           }
        }]
    });
    }
 $(document).ready(function(){
    window.setTimeout( startSlick, 500 );
    @if(session()->has('success'))
        $.notify("{{session()->get('success')}}",'success');
    @endif
    @if(session()->has('error'))
    $.notify("{{session()->get('error')}}",'error');
    @endif

    $('.slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [{
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
           breakpoint: 400,
           settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
           }
        }]
    });
 });
     flatpickr(".datepicker",{});
      /*const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });*/
		var tpj=jQuery;


	</script>
<!-- The core Firebase JS SDK is always required and must be listed first -->

<script src="{{ asset('js/firebase8.3.2.js')}}"></script>
<script src="{{asset('js/firebase.js')}}"></script>
@yield('scripts')
<script>
$(document).ready(function(){

 
    startFCM();
  
});
</script>
</body>
</html>
