<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Dento - Dentist &amp; Medical HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Dento - Dentist &amp; Medical HTML Template</title>

  <!-- Favicon -->
 {{--  <link rel="icon" href="{{ url('/cliente/img/core-img/favicon.ico"> --}}
  <link rel="icon" href="{{ url('/cliente/img/core-img/favicon.ico') }}"> 
  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="{{ url('/cliente/style.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ url('/cliente/css/whatsapp.css') }}">

</head>

<body>

<a href="https://api.whatsapp.com/send?phone=51961019219&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20DentalCoes?%20." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>

  <!-- Preloader -->
  <div id="preloader">
    <div class="preload-content">
      <div id="dento-load"></div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area">
    <!-- Top Header Area -->
    <div class="top-header-area">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <!-- Top Content -->
          <div class="col-6 col-md-9 col-lg-8">
            <div class="top-header-content">
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="28 Jackson Street, Chicago, 7788569 USA"><i class="fa fa-map-marker"></i> <span>San Juan</span></a>
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="info.dento@gmail.com"><i class="fa fa-envelope"></i> <span>dentalcoes@gmail.com</span></a>
            </div>
          </div>
          <!-- Top Header Social Info -->
          <div class="col-6 col-md-3 col-lg-4">
            <div class="top-header-social-info text-right">
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><i class="fa fa-linkedin"></i></a>
              <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Top Header End -->

    <!-- Main Header Start -->
    <div class="main-header-area">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <!-- Classy Menu -->
          <nav class="classy-navbar justify-content-between" id="dentoNav">

            <!-- Logo -->
            <a class="nav-brand" href="index.html"><img src="{{ url('/cliente/img/core-img/logo.png') }}" alt=""></a>

            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <!-- Menu -->
            <div class="classy-menu">

              <!-- Close Button -->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>

              <!-- Nav Start -->
              <div class="classynav">
                <ul id="nav">
                  <li><a href="{{ url('index') }}">Home</a></li>
                  <li><a href="#">Secciones</a>
                    <ul class="dropdown">
                      <li><a href="{{ url('index') }}">- Home</a></li>
                      <li><a href="{{ url('about') }}">- Sobre Nosotros</a></li>
                      <li><a href="{{ url('service') }}">- Servicios</a></li>
                      <li><a href="{{ url('pricing') }}">- Precios</a></li>
                     <!--  <li><a href="blog.blade.php">- Blog</a></li> -->
                <!--       <li><a href="blog-details.blade.php">- Blog Details</a></li> -->
                      <li><a href="{{ url('contact') }}">- Contactanos</a></li>
                     <!--  <li><a href="#">- Dropdown</a>
                        <ul class="dropdown">
                          <li><a href="#">- Dropdown Item</a></li>
                          <li><a href="#">- Dropdown Item</a>
                            <ul class="dropdown">
                              <li><a href="#">- Even Dropdown</a></li>
                              <li><a href="#">- Even Dropdown</a></li>
                              <li><a href="#">- Even Dropdown</a></li>
                              <li><a href="#">- Even Dropdown</a></li>
                            </ul>
                          </li>
                          <li><a href="#">- Dropdown Item</a></li>
                          <li><a href="#">- Dropdown Item</a></li>
                        </ul>
                      </li> -->
                    </ul>
                  </li>
                  <li><a href="{{ url('about') }}">Sobre Nosotros</a></li>
                  <li><a href="{{ url('service') }}">Servicios</a></li>
                  <li><a href="{{ url('pricing') }}">Precios</a></li>
                  <!-- <li><a href="#">Blog</a> -->
                   <!--  <ul class="dropdown">
                      <li><a href="blog.html">- Blog</a></li>
                      <li><a href="blog-details.html">- Blog Details</a></li>
                    </ul> -->
                  </li>
                  <li><a href="{{ url('contact') }}">Contactanos</a></li>
                </ul>
              </div>
              <!-- Nav End -->
            </div>

            <!-- Booking Now Button -->
            <!-- <a href="#" class="btn dento-btn booking-btn">Booking Now</a> -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->