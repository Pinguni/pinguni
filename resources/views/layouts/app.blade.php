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
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
    
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/224691c555.js" crossorigin="anonymous"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(window).on('load', function() {
            $('.preloader').fadeOut('slow');
        });
    </script>
    
    <!-- 
        Full Story 
    -->
    <script>
        if ("{{ env('APP_ENV') }}" === 'production')
        {
            window['_fs_debug'] = false;
            window['_fs_host'] = 'fullstory.com';
            window['_fs_script'] = 'edge.fullstory.com/s/fs.js';
            window['_fs_org'] = 'TR17E';
            window['_fs_namespace'] = 'FS';
            (function(m,n,e,t,l,o,g,y){
                if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
                g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
                o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_script;
                y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
                g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
                g.anonymize=function(){g.identify(!!0)};
                g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
                g.log = function(a,b){g("log",[a,b])};
                g.consent=function(a){g("consent",!arguments.length||a)};
                g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
                g.clearUserCookie=function(){};
                g._w={};y='XMLHttpRequest';g._w[y]=m[y];y='fetch';g._w[y]=m[y];
                if(m[y])m[y]=function(){return g._w[y].apply(this,arguments)};
                g._v="1.2.0";
            })(window,document,window['_fs_namespace'],'script','user');
        }
    </script>
    
    <!-- 
        Headway 
    -->
    <script>
      // @see https://docs.headwayapp.co/widget for more configuration options.
      var HW_config = {
        selector: "#headway", // CSS selector where to inject the badge
        account:  "7XYwYJ"
      }
    </script>
    <script async src="https://cdn.headwayapp.co/widget.js"></script>

    <!-- 
        Drift 
    -->
    <script>
        if ("{{ env('APP_ENV') }}" === 'NONE')
        {
            "use strict";

            !function() {
              var t = window.driftt = window.drift = window.driftt || [];
              if (!t.init) {
                if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
                t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
                t.factory = function(e) {
                  return function() {
                    var n = Array.prototype.slice.call(arguments);
                    return n.unshift(e), t.push(n), t;
                  };
                }, t.methods.forEach(function(e) {
                  t[e] = t.factory(e);
                }), t.load = function(t) {
                  var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                  o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                  var i = document.getElementsByTagName("script")[0];
                  i.parentNode.insertBefore(o, i);
                };
              }
            }();
            drift.SNIPPET_VERSION = '0.3.1';
            drift.load('pmdvkwmviwxw');
        }
    </script>
    
    <!-- Styles -->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utilities.css') }}" rel="stylesheet">
    
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
                        <button id = "mhc" class = "no-decoration uppercase">
                            <strong><span>SN</span></strong>
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
                    <a href = {{ url('/resources/search') }}>Search</a>
                </div>
                

                <!-- 
                    User menu
                -->
                <div id = "user-menu">
                    <div>
                        <a href = "{{ url('/') }}">
                            <button id = "logo" class = "no-decoration uppercase">
                                <strong><span><img src = "{{ asset('img/logo.png') }}" /></span></strong>
                            </button>
                        </a>
                    </div>
                    @guest
                    @else
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
            Headway
        -->
        <div id = "headway"></div>
        
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
    
</body>
</html>
