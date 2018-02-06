<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - 戊戌梅竹後台</title>

    <link rel="Shortcut Icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">

    <meta name="description" content="戊戌梅竹官方網站，提供賽程、票務、戰況、轉播等梅竹賽之即時資訊。">
    <meta name="og:title" content="@yield('title') - 戊戌梅竹 | 2018 Meichu Games">
    <meta name="og:description" content="戊戌梅竹官方網站，提供賽程、票務、戰況、轉播等梅竹賽之即時資訊。">
    <meta name="og:site_name" content="戊戌梅竹 | 2018 Meichu Games">
    <meta name="og:type" content="website">
    <meta property="og:url" content=" https://meichu.games">
    <meta property='og:image' content="{{ asset('image/screenshot.png') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-fix-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/m') }}">
                        戊戌梅竹後台
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li class="{{ Request::segment(2) === 'login' ? 'active' : null }}">
                                <a href="{{ route('login') }}">登入</a>
                            </li>
                        @else
                            @if(Auth::user()->group  == 'admin')
                                <li class="{{ Request::segment(2) === 'users' ? 'active' : null }}">
                                    <a href="{{ url('/m/users') }}">使用者</a>
                                </li>
                            @endif
                            @if(Auth::user()->group  == 'committee' ||  Auth::user()->group  == 'admin')
                                <li class="{{ Request::segment(2) === 'games' ? 'active' : null }}">
                                    <a href="{{ url('/m/games') }}">賽事</a>
                                </li>
                                <li class="{{ Request::segment(2) === 'teams' ? 'active' : null }}">
                                    <a href="{{ url('/m/teams') }}">隊伍</a>
                                </li>
                            @endif
                                <li class="{{ Request::segment(2) === 'events' ? 'active' : null }}">
                                    <a href="{{ url('/m/events') }}">活動</a>
                                </li>
                                <li class="{{ Request::segment(2) === 'news' ? 'active' : null }}">
                                    <a href="{{ url('/m/news') }}">消息</a>
                                </li>
                                <li class="{{ Request::segment(2) === 'losts' ? 'active' : null }}">
                                    <a href="{{ url('/m/losts') }}">遺失物</a>
                                </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li class="{{ Request::segment(2) === 'changepassword' ? 'active' : null }}">
                                        <a href="{{ url('/m/changepassword') }}">變更密碼</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            登出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @yield('content')
                    
                </div>
            </div>
        </div>

    </div>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112938427-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-112938427-1');
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
