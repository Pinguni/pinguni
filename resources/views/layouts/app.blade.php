<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Page Title -->
        <title>@yield('title') | {{ env('APP_NAME') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>

        <!-- Scripts -->
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(window).on('load', function() {
                $('.preloader').fadeOut('slow');
            });
        </script>

        <!-- Styles -->
        <link href="/css/base.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        <!-- deferred styles -->
        <link rel="preload" href="/css/utilities.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="/css/utilities.css"></noscript>

        @yield('head')
    </head>


    <body class = "@yield('bodyClass')">

        <!-- 
            Preloader CSS and HTML from https://devdojo.com/tutorials/get-a-preloader-on-your-site-with-jquery 
        -->
        <style>
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background-image: url("{{ asset('img/loadingballs.gif') }}");
                background-repeat: no-repeat; 
                background-color: #FFF;
                background-position: center;
            }
        </style>
        <div class="preloader"></div>

        <!--
            Containing the main app
        -->
        <div id = "app">

            <!--
                Div wrapping the <nav> bar
            -->
            <div class = "nav-wrapper">
                <nav>

                    <!-- 
                        Link to homepage
                    -->
                    <div>
                        <a href = "{{ url('/') }}">
                            <button id = "logo" class = "no-decoration uppercase">
                                <strong><span><img src = "{{ asset('img/logo.png') }}" /></span></strong>
                            </button>
                        </a>
                    </div>

                    <!--
                        About page
                    -->
                    <div>
                        <a href = {{ url('/about') }}>About</a>
                    </div>

                    <!--
                        Search bar
                    -->
                    <div>
                        <a href = {{ url('/resources/search') }}>Resources</a>
                    </div>


                    <!-- 
                        User menu
                    -->
                    <div id = "user-menu">
                        <div>
                            @guest
                                <span><a href="{{ route('login') }}">{{ __('Login') }}</a> / <a href = "https://forms.gle/YedgjA9XQvYo37pa9" class = "-ml-2">Apply</a></span>
                            @else
                                <a href = '{{ url("/u/" . Auth::user()->username) }}'><span>{{ Auth::user()->username }}</span></a>
                            @endguest
                        </div>
                        @guest
                        @else
                        @if (Auth::user()->role == 'admin')
                        <div>
                            <a href = '{{ url("/admin") }}'>Admin</a>
                        </div>
                        @endif
                        <div>
                            <a href = '{{ url("/dash") }}'>Dashboard</a>
                        </div>
                        <div>
                            <a href = '{{ url("/") }}'>Community</a>
                        </div>
                        @endguest
                    </div>
                </nav>
            </div>

            <!-- 
                Whitespace Div 
            -->
            <div style = "height: 3rem"></div>

            <!-- 
                Hero Section
            -->
            @yield('hero')

            <!--
                Main Page Content
            -->
            <main class = "@yield('mainClass')">
                @yield('content')
            </main>

            <!--
                Footer
            -->
            <footer>
                <div>
                    <p>Copyright &copy; 2020 {{ env('APP_NAME') }}.</p>
                    <p>
                        <a href = "https://laravel.com" target = "_blank">Laravel</a> | Icons made by <a href="https://www.flaticon.com/authors/nikita-golubev" title="Nikita Golubev" target = "_blank">Nikita Golubev</a> from <a href="https://www.flaticon.com/" title="Flaticon" target = "_blank">www.flaticon.com</a> | <a href = "https://svgbackgrounds.com" target = "_blank">SVG Backgrounds</a>
                    </p>
                </div>
            </footer>

        </div>

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/224691c555.js" crossorigin="anonymous" defer></script>
        
    </body>
</html>
