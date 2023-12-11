<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />


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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .ui-widget-content {
    border: 1px solid #dddddd;
    background: #000000!important;
    color: #ec1414!important;
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
        <a href="index.html" class="standard-logo"><img src="{{ asset('frontend/demos/spa/images/logo.png')}}" alt="Canvas Logo"></a>
        <a href="index.html" class="retina-logo"><img src="{{ asset('frontend/demos/spa/images/logo.png')}}" alt="Canvas Logo"></a>
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
        @if (Route::has('login'))
        
            @auth
            <li class=" dropdown">  
            <!-- Right navbar links -->
        
         
              <a class="" data-toggle="dropdown" href="#" aria-expanded="false">
                  {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu " style="left: inherit; right: 0px;">
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

   
    
    <!-- Main Slider -->
    <section id="slider" class="slider-element revslider-wrap full-screen clearix d-none">
        <div id="rev_slider_10_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="fashion1" style="background-color:transparent;padding:0px;">
        
        <div id="rev_slider_10_1" class="rev_slider" style="display:none;" data-version="5.0.7">
        <ul>
        
        <li data-index="rs-36" class="dark" data-transition="fadetoleftfadefromright" data-fstransition="fade" data-slotamount="7" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="Enjoy Nature" data-description="">
        
        <img src="{{ asset('frontend/demos/spa/images/slider/1.jpg')}}" style='background-color:#ffffff' alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
        <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0" id="slide-36-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-basealign="slide" data-responsive_offset="on" style="z-index: 5; background: rgba(0,0,0,0.2)">
        </div>
        
        <div class="tp-caption -  " id="slide-35-layer-1" data-x="['right','right','right','right']" data-hoffset="['40','40','40','40']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['40','40','40','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-style_hover="cursor:pointer;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-actions='[{"event":"click","action":"jumptoslide","slide":"next","delay":""}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400;padding:3px 8px 3px 8px;border-style:solid;border-width:1px;border-radius:30px 30px 30px 30px;"><i class="icon-angle-down"></i>
        </div>
        
        <div class="tp-caption Fashion-BigDisplay   tp-resizeme" id="slide-36-layer-5" data-x="['center','center','center','center']" data-hoffset="['255','231','211','62']" data-y="['middle','middle','middle','middle']" data-voffset="['-30','-18','-48','-28']" data-fontsize="['80','50','50','56']" data-lineheight="['100','50','50','50']" data-width="['none','265','265','265']" data-height="['none','100','100','100']" data-whitespace="['nowrap','normal','normal','normal']" data-transform_idle="o:1;" data-transform_in="x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 9; white-space: nowrap;">Spa Treatment
        </div>
        
        <div class="tp-caption Fashion-TextBlock   tp-resizeme" id="slide-36-layer-6" data-x="['center','center','center','center']" data-hoffset="['189','219','200','39']" data-y="['middle','middle','middle','middle']" data-voffset="['120','130','80','110']" data-fontsize="['20','17','17','17']" data-lineheight="['40','30','30','30']" data-width="219" data-height="161" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[-100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 10; min-width: 219px; max-width: 219px; max-width: 161px; max-width: 161px; white-space: normal;"><i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        </div>
        
        <div class="tp-caption Fashion-SmallText   tp-resizeme" id="slide-36-layer-7" data-x="['center','center','center','center']" data-hoffset="['105','130','105','-39']" data-y="['middle','middle','middle','middle']" data-voffset="['-85','-85','-110','-95']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 11; white-space: nowrap;">UNISEX
        </div>
        
        <div class="tp-caption Fashion-TextBlock   tp-resizeme" id="slide-36-layer-8" data-x="['center','center','center','center']" data-hoffset="['224','254','230','80']" data-y="['middle','middle','middle','middle']" data-voffset="['120','130','79','110']" data-fontsize="['20','17','17','17']" data-lineheight="['40','30','30','30']" data-width="219" data-height="161" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 12; min-width: 219px; max-width: 219px; max-width: 161px; max-width: 161px; white-space: normal; font-weight: 600;">Body Scrub<br />
        Body Wrap<br />
        Thai Therapy
        Baliness Massage<br />
        </div>
        </li>
        
        <li data-index="rs-37" data-transition="fadetoleftfadefromright" data-fstransition="fade" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="http://server.local/revslider/wp-content/uploads/" data-rotate="0" data-saveperformance="off" data-title="Smart Look" data-description="">
        
        <img src="{{ asset('frontend/demos/spa/images/slider/2.jpg')}}" style='background-color:#ffffff' alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
        
        
        <div class="tp-caption -  " id="slide-37-layer-3" data-x="['right','right','right','right']" data-hoffset="['40','40','40','40']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['40','40','40','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-style_hover="cursor:pointer;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-actions='[{"event":"click","action":"jumptoslide","slide":"next","delay":""}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(0, 0, 0, 1.00);padding:3px 8px 3px 8px;border-color:rgba(0, 0, 0, 1.00);border-style:solid;border-width:1px;border-radius:30px 30px 30px 30px;"><i class="icon-angle-down"></i>
        </div>
        
        <div class="tp-caption Fashion-BigDisplay   tp-resizeme" id="slide-37-layer-5" data-x="['center','center','center','center']" data-hoffset="['230','201','211','92']" data-y="['middle','middle','middle','middle']" data-voffset="['-30','-18','-18','-18']" data-fontsize="['80','50','50','56']" data-lineheight="['100','50','50','50']" data-width="['none','265','265','265']" data-height="['none','100','100','100']" data-whitespace="['nowrap','normal','normal','normal']" data-transform_idle="o:1;" data-transform_in="x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 9; white-space: nowrap; color: #222;">Beauty Spa
        </div>
        
        <div class="tp-caption Fashion-TextBlock   tp-resizeme" id="slide-37-layer-6" data-x="['center','center','center','center']" data-hoffset="['209','190','200','69']" data-y="['middle','middle','middle','middle']" data-voffset="['120','130','100','90']" data-fontsize="['20','17','17','17']" data-lineheight="['40','30','30','30']" data-width="219" data-height="161" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[-100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 10; min-width: 219px; max-width: 219px; max-width: 161px; max-width: 161px; white-space: normal;color: #222;"><i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        <i class="icon-line-check"></i><br>
        </div>
        
        <div class="tp-caption Fashion-SmallText   tp-resizeme" id="slide-37-layer-7" data-x="['center','center','center','center']" data-hoffset="['115','100','109','-9']" data-y="['middle','middle','middle','middle']" data-voffset="['-85','-85','-85','-85']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 11; white-space: nowrap; color: rgba(0, 0, 0, 0.6);">WOMEN
        </div>
        
        <div class="tp-caption Fashion-TextBlock   tp-resizeme" id="slide-37-layer-8" data-x="['center','center','center','center']" data-hoffset="['244','224','240','110']" data-y="['middle','middle','middle','middle']" data-voffset="['120','130','99','90']" data-fontsize="['20','17','17','17']" data-lineheight="['40','30','30','30']" data-width="219" data-height="161" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="x:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="on" style="z-index: 12; min-width: 219px; max-width: 219px; max-width: 161px; max-width: 161px; white-space: normal; font-weight: 400; color: #222;">Manicure<br />
        Hair Cut<br />
        Head Wash<br />
        Fruit Bleach
        </div>
        </li>
        
        <li data-index="rs-38" class="dark" data-transition="slideoververtical" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
        
        <img src="{{ asset('frontend/demos/spa/images/videos/1.jpg')}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
        
        
        <div class="rs-background-video-layer" data-forcerewind="on" data-volume="mute" data-videowidth="100%" data-videoheight="100%" data-videomp4="{{ asset('frontend/demos/spa/images/videos/spa.webm')}}" data-videopreload="preload" data-videoloop="true" data-forceCover="1" data-aspectratio="16:9" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true"></div>
        
        <div class="tp-caption -  " id="slide-38-layer-1" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeOut;" data-transform_out="auto:auto;s:1500;e:Power2.easeOut;" data-start="500" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 5; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><div class="coverdark"></div>
        </div>
        
        <div class="tp-caption -  " id="slide-36-layer-3" data-x="['right','right','right','right']" data-hoffset="['40','40','40','40']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['40','40','40','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-style_hover="cursor:pointer;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-actions='[{"event":"click","action":"jumptoslide","slide":"next","delay":""}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #FFF;padding:3px 8px 3px 8px;border-color:rgba(255,255,255, 1.00);border-style:solid;border-width:1px;border-radius:30px 30px 30px 30px;"><i class="icon-angle-down"></i>
        </div>
        
        <div class="tp-caption Fashion-BigDisplay   tp-resizeme" id="slide-38-layer-2" data-x="['left','center','center','center']" data-hoffset="['40','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','-50','-130','-130']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1500;e:Power2.easeInOut;s:1500;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; line-height: 100px;">Video Background
        </div>
        
        <div class="tp-caption Fashion-BigDisplay   tp-resizeme" id="slide-38-layer-3" data-x="['left','middle','middle','center']" data-hoffset="['40','-100','-90','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','0','-90','-70']" data-width="none" data-fontweight="['400','400','400','900']" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1500;e:Power2.easeInOut;s:1500;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="750" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap; font-size: 16px;text-transform: uppercase; line-height: 22px; font-weight: 400; font-family: 'Lato';">Visit Our Store
        </div>
        
        <div class="tp-caption Fashion-TextBlock   tp-resizeme" id="slide-38-layer-4" data-x="['right','center','center','center']" data-hoffset="['40','0','25','20']" data-y="['middle','middle','middle','middle']" data-voffset="['46','110','15','50']" data-fontsize="['20','20','20','17']" data-lineheight="['40','30','30','34']" data-fontweight="['400','300','300','400']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1500;e:Power2.easeInOut;s:1500;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; white-space: nowrap;"><i class="icon-map-marker" style="color:rgba(255,255,255,0.35);"></i> Shop Street 234, LA<br />
        <i class="icon-phone" style="color:rgba(255,255,255,0.35);"></i> 0800 987654<br />
        <i class="icon-envelope" style="color:rgba(255,255,255,0.35);"></i> <a href="http://themes.semicolonweb.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="177e79717857726d7176647f7e78793974787a">[email&#160;protected]</a><br />
        <i class="icon-clock" style="color:rgba(255,255,255,0.35);"></i> Monday - Saturday 07:30 - 22:30
        </div>
        </li>
        </ul>
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
        </div>
        </section>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
 $(document).ready(function(){
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

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    const firebaseConfig = {
      apiKey: "AIzaSyDSo0Bmcn2Y0xLoZzZjgZUH6kRD_PVg50Y",
      authDomain: "spabooking-f8af7.firebaseapp.com",
      projectId: "spabooking-f8af7",
      storageBucket: "spabooking-f8af7.appspot.com",
      messagingSenderId: "118064225989",
      appId: "1:118064225989:web:97b0e8b578840414441aac",
      measurementId: "G-SVYMP9WNRM"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save_token") }}',
                    type: 'POST',
                    data: {
                        token: response,
                        _token:"{{ csrf_token()  }}",
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        $.notify("Congratulations!Notifications Enabled",'success')
                    },
                    error: function (error) {
                        $.notify(error,'error');
                    },
                });
            }).catch(function (error) {
                $.notify(error,'error');
            });
    }
    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
     
@yield('scripts')
</body>
</html>
