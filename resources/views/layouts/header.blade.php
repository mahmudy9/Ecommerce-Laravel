<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce App</title>
    <!-- Font Awesome -->
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('web-fonts-with-css/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <!-- Your custom styles (optional) -->
<style>

.blog-footer {
  padding: 2.5rem 0;
  color: #999;
  text-align: center;
  background-color: #f9f9f9;
  border-top: .05rem solid #e5e5e5;
}
.blog-footer p:last-child {
  margin-bottom: 0;
}


/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  background-color: white;
  height: 40px;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}


</style>


<script src="https://js.stripe.com/v3/"></script>


</head>

<body>

    <!--Main Navigation-->
    <header>

        <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container" >
  <a class="navbar-brand" href="{{url('/')}}">Market</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01 navbarResponsive">
                
                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Categories <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="themes">
                @foreach($categories as $category)
                <a class="dropdown-item" href="{{url('category/'.$category->id.'/'.strtolower(str_replace(' ', '-' ,$category->name)))}}">{{$category->name}}</a>
                @endforeach
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Brands <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="themes">
                @foreach($brands as $brand)
                <a class="dropdown-item" href="{{url('brand/'.$brand->id.'/'.strtolower(str_replace(' ' , '-' ,$brand->name)))}}">{{$brand->name}}</a>
                @endforeach
              </div>
            </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{url('blog')}}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('contact')}}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('about')}}">About</a>
                        </li>

                    </ul>
                 

                    <!-- Search form -->
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    </form>

                       <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item dropdown">  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="true">Register<span class="caret"></span></a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item"  href="{{route('register')}}">Register as Customer</a>
                    <a class="dropdown-item"  href="{{route('vendor.register')}}">Register As Vendor</a>
                    </div>
                    </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isadmin == '1')
                                <a class="dropdown-item" href="{{url('admin/dashboard')}}">Dashboard</a>
                                @endif
                                @if(Auth::user()->isvendor == '1')
                                <a class="dropdown-item" href="{{url('vendor/dashboard')}}">Dashboard</a>
                                @endif
                                @if(Auth::user()->isvendor == '0' && Auth::user()->isadmin == '0' )
                                <a class="dropdown-item" href="{{url('user/dashboard')}}">Dashboard</a>
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
                        @endguest
                    @auth
                    @if(Auth::user()->isvendor==0 && Auth::user()->isadmin==0)

                    <li><a class="nav-link" href="{{url('user/cart')}}"><i class="fas fa-lg fa-shopping-cart"></i>
                    <span id="cart">{{$count}}</span>
                    </a></li>
                    @endif
                    @endauth

                    </ul>

                    <!-- Links -->


                </div>
                <!-- Collapsible content -->

            </div>
        </nav>
        <!--/.Navbar-->

    </header>
    <!--Main Navigation-->
     <br><br>
