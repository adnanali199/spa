<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="home" content="{{route('/')}}">
    <title>{{ config('app.name', 'Pool Booking') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/slick.min.css')}}"  />

    <style>
        .content
        {
            box-sizing: border-box;
            padding:0px 20px;
          
        }
        .select2-container .select2-selection--single{
            height:40px!important;
        }
        .dataTables_filter{
            float: right;
        }
        .fc .fc-button{
            padding:3px 5px;
            margin-top:3px;
            
        }
        .form-control.checkbox{
            width:20px;
            display: inline-block;
        }
       .fc-dayGridMonth-button,.fc-timeGridWeek-button{
        display:none!important;
       }
       button.nav-link{
        border-radius: 0px!important;
    }
    .nav-link.active{
        background: #00a75f!important;
        color:#FFF!important;
    }
    .fc-h-event{
        background-color:rgba(0,0,0,0)!important;
        border:none!important;
    }
    </style>

    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                  <!--  <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>-->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">SPA Booking</span>
        </a>

        @include('layouts.owner-nav')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <php echo date('Y') ?> <a href="#">SPA Booking</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<link rel="modulepreload" href="{{ asset('build/assets/app-83c4400f.js') }}" />
<script type="module" src="{{ asset('build/assets/app-83c4400f.js') }}"></script><!-- AdminLTE App -->

<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
<script src="{{ asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/slick.js')}}" ></script>
<script>
    $(document).ready(function(){
       
        $('.slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
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
              slidesToShow: 2,
              slidesToScroll: 1
           }
        }]
    });
    });
</script>

@yield('scripts')
<script src="{{ asset('js/firebase8.3.2.js')}}"></script>
<script src="{{asset('js/firebase_owner.js')}}"></script>
<script>
$(document).ready(function(){

 
    startFCM();
  
});
</script>
</body>
</html>
