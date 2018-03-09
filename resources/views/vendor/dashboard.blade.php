<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/css/fontastic.css')}}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/css/grasp_mobile_progress_circle-1.0.0.min.css')}}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('bootstrap-dashboard/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('bootstrap-dashboard/img/favicon.ico')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->

    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">Anderson Hardy</h2><span>Web Developer</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="{{url('vendor/dashboard')}}"> <i class="icon-home"></i>Home(Orders Requests)</a></li>
            <li><a href="{{url('vendor/createproduct')}}"> <i class="icon-form"></i>Create Product</a></li>
            <li><a href="{{url('vendor/myproducts')}}"> <i class="icon-form"></i>My Products</a></li>
          </ul>
        </div>
      </div>

    </nav>

    <div class="page">
     <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Bootstrap </span><strong class="text-primary">Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
                 <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}" role="button"  aria-haspopup="true" aria-expanded="false">
                                    home</a>
                 </li>

                 <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isadmin == '1')
                                <a class="dropdown-item" href="{{url('admin/dashboard')}}">Dashboard</a>
                                @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
              </ul>
            </div>
          </div>
        </nav>
      </header>
<div class="modal fade" id="modall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You sure you want to delete Category
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="delbtn" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>        @yield('content')
 
    </div>
    </div>

    <!-- Javascript files-->
    <script src="{{asset('js/jquery.min.js')}}" ></script>
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
        <script src="{{asset('js/popper.min.js')}}" ></script>

                <script src="{{asset('js/custom.js')}}"></script>

    <script src="{{asset('bootstrap-dashboard/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap-dashboard/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('bootstrap-dashboard/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('bootstrap-dashboard/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
    <script src="{{asset('bootstrap-dashboard/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('bootstrap-dashboard/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('bootstrap-dashboard/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('bootstrap-dashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('bootstrap-dashboard/js/charts-home.js')}}"></script>
    <!-- Main File-->
    <script src="{{asset('bootstrap-dashboard/js/front.js')}}"></script>
  </body>
</html>
