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
            <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector : "#mytext",
            height   : 400,
            width    : 700,
            //toolbar: 'undo redo | styleselect | bold italic | link image',
            plugins : 'codesample link image hr table textcolor contextmenu lists charmap preview anchor spellchecker searchreplace code textcolor',
            toolbar1  : 'undo redo styleselect bold italic forecolor backcolor alignleft aligncenter alignright charmap preview anchor spellchecker searchreplace ',
             toolbar2 :'bullist numlist outdent indent hr blockquote table tabledelete textcolor codesample code link unlink image source',
        });
    </script>


  </head>
  <body>
    <!-- Side Navbar -->

    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"></h2><span>Admin</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Home(Orders Requests)</a></li>
            <li><a href="{{url('admin/createproduct')}}"> <i class="icon-form"></i>Create Product</a></li>
            <li><a href="{{url('admin/myapproved-products')}}"> <i class="icon-form"></i>My Approved Products</a></li>
            <li><a href="{{url('admin/mydisapproved-products')}}"> <i class="icon-form"></i>My DisApproved Products</a></li>
            

            <li><a href="{{url('admin/approve-products')}}"> <i class="icon-form"></i>Approve Products</a></li>
            <li><a href="{{url('admin/approved-products')}}"> <i class="icon-form"></i>Approved Products</a></li>
            <li><a href="{{url('admin/disapproved-products')}}"> <i class="icon-form"></i>DisApproved Products</a></li>

            <li><a href="{{url('admin/approvereviews')}}"> <i class="fa fa-bar-chart"></i>Approve Reviews</a></li>
            <li><a href="{{url('admin/approvedreviews')}}"> <i class="fa fa-bar-chart"></i>Approved Reviews</a></li>

            <li><a href="{{url('admin/createcategory')}}"> <i class="icon-grid"></i>Create Category</a></li>
            <li><a href="{{url('admin/createbrand')}}"> <i class="icon-grid"></i>Create Brand</a></li>
            <li><a href="{{url('admin/createpost')}}"> <i class="icon-grid"></i>Create Post</a></li>
            <li><a href="{{url('admin/posts')}}"> <i class="icon-grid"></i>Posts List</a></li>

            <li><a href="{{url('admin/vieworders')}}"> <i class="icon-grid"></i>View Orders</a></li>
            <li><a href="{{url('admin/viewusers')}}"> <i class="icon-grid"></i>View Users</a></li>
            <li><a href="{{url('admin/viewvendors')}}"> <i class="icon-grid"></i>View Vendors</a></li>
            <li><a href="{{url('admin/viewcontacts')}}"> <i class="icon-grid"></i>View Contacts</a></li>
            <li><a href="{{url('admin/viewsubscribers')}}"> <i class="icon-grid"></i>View Subscribers</a></li>
            <li><a href="{{url('admin/settings')}}"> <i class="icon-grid"></i>Change Settings</a></li>
            <li><a href="{{url('admin/password')}}"> <i class="icon-grid"></i>Change Password</a></li>


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
                                <a class="nav-link" href="{{url('admin/dashboard')}}" role="button" aria-expanded="false">
                                   Dashboard: {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
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
