<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Otomow'){{-- {{ config('app.name', 'Laravel') }} --}}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/5b063770ce.js" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app" class="wrapper">
        <header>
            <nav style="background: #D2D2D2;" class="navbar navbar-expand-md shadow-sm fixed-top" >
                <div class="container-xl">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Otomow
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a style="color: #333333" href="/catalogs" class="nav-link">Catalog</a>
                            </li>

                            <ul class="navbar-nav catalog-link-media">
                                <li class="nav-item dropdown">
                                <button style="padding-left:0px; border: 0px; color: #333333;" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Catalog
                                </button>
                                <ul style="border: 0px; background: #D2D2D2;" class="dropdown-menu">
                                    @foreach ($categories_sidebar as $item)
                                        <li class="nav-item ps-3">
                                            <a style="color: #333333" href="/cat/{{$item->slug}}" class="nav-link">
                                                {{$item->name}}. Items: {{$item->catalogs_count}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                </li>
                            </ul>

                            <li class="nav-item">
                                <a style="color: #333333" href="/contacts" class="nav-link">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: #333333" href="/aboutUs" class="nav-link">About US</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            {{-- Search --}}
                            <form class="d-flex pr-3 search-form" action="/search" method="get">
                                <input class="form-control me-2 search-q search-input-menu" placeholder="Search" name="q" autocomplete="off">
                                <button class="btn btn-outline-dark">Search</button>
                            </form>
                              
                            {{-- <form action="/search" method="get">
                                <input type="text" name="q">
                                <button class="btn btn-light">Search</button>
                            </form> --}}
                            {{-- Cart --}}
                            <li class="nav-item" style="margin: 0 10px 0 10px; ">
                                <a style="color: #333333;" class="nav-link" href="/carts">
                                    <i class="fa-solid fa-bag-shopping" style="font-size: 17px"></i> Cart
                                </a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a style="color: #333333" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a style="color: #333333" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a style="color: #333333" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/history">
                                            History
                                        </a>
                                        <a style="color: #333333" class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main style="margin-top: 50px;">
            <div class="">
                @yield('homeContent')
            </div> 
            <div class="container py-4">
                @yield('content')
            </div> 
            <div class="container" style="margin-top: -20px">
                <div style="width: 90%; margin-left: 5%">
                    <hr style="border: 1px solid;">
                    <h2 class="p-3" style="text-align: center; font-size: 35px;color: #D4D4D4; font-weight: 500; font-family: Montserrat">Featured Brands</h2>
                    
                    <div class="slider" style="margin-bottom: 40px">
                        @for ($i = 1; $i <= 6; $i++)
                        <div class="slider-item">
                            <img style="width: 100%; filter: invert(1) grayscale(1);" class='slider-item-img' src="/image/banner/brand-{{ $i }}.png" alt="Banner {{ $i }}">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </main>
        
        <footer style="background: #D2D2D2;">
            <div class="container py-3">
                <h2 style="color: black"><strong>Otomow</strong></h2>
                <div class="row justify-content-between footer-main">
                    <div class="col-md-2 a py-2">
                        <h3 style="margin: 0; padding: 0; font-weight: 500; padding-bottom: 5px">Links</h3>
                        <a href="/catalogs">Catalog</a><br>
                        <a href="">About US</a><br>
                        <a href="">Support</a><br>
                        <a href="/contacts">Contacts</a><br>
                    </div>
                    <div class="col-md-3 py-2">
                        <h3 style="margin: 0; padding: 0; font-weight: 500; padding-bottom: 5px">Contacts</h3>
                        <a href="mailto:biriuk.yevhenii@gmz31.com"><strong>Mail: </strong>biriuk.yevhenii@gmz31.com</a><br>
                        <a href="tel:+48536286013"><strong>Phone number: </strong>+48 536 286 013 <br></a>
                        <a href="#"><strong>Address:</strong> Adama Bienia 16, Poland</a>
                    </div>
                    <div class="col-md-4 py-2">
                        <h3 style="margin: 0; padding: 0; font-weight: 500; padding-bottom: 5px">About Us</h3>
                        <div>Our store is the best place to buy business clothing. We offer a wide range of suits, shirts, pants, jackets, and more.</div>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="image/icons/icon-facebook.svg" alt=""></a>
                            <a href="#"><img src="image/icons/icon-twitter.svg" alt=""></a>
                            <a href="#"><img src="image/icons/icon-instagram.svg" alt=""></a>
                            <a href="#"><img src="image/icons/icon-pinterest.svg" alt=""></a>
                            <a href="#"><img src="image/icons/icon-youtube.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-3 py-2">
                        <h3 style="margin: 0; padding: 0; font-weight: 500; padding-bottom: 5px">Subscribe to news</h3>
                        <small style="color: black !important;">Be the first to know about promotions and news</small>
                        <form id="mailingForm" action="/mailingAddToDb" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="email" name="email">
                                <button type="submit" class="btn btn-outline-dark">Subscribe</button>
                            </div>
                        </form>                        

                    </div>
                </div>
            </div>
            <div class="p-2" style="text-align: center; color:#FFFFFF; background:#1A1A1A">
                © 2023 All rights reserved
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Подключаем библиотеку jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Подключаем стили и скрипты для Slick Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!--Plugin JavaScript file Price Range-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

</body>
</html>
