<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - 戊戌梅竹 | 2018 Meichu Games</title>

        <link rel="Shortcut Icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Signika+Negative" rel="stylesheet">

        <meta name="description" content="戊戌梅竹官方網站，提供賽程、票務、戰況、轉播等梅竹賽之即時資訊。">
        <meta name="og:title" content="@yield('title') - 戊戌梅竹 | 2018 Meichu Games">
        <meta name="og:description" content="戊戌梅竹官方網站，提供賽程、票務、戰況、轉播等梅竹賽之即時資訊。">
        <meta name="og:site_name" content="戊戌梅竹 | 2018 Meichu Games">
        <meta name="og:type" content="website">
        <meta property="og:url" content=" https://meichu.games">
        <meta property='og:image' content="{{ asset('images/screenshot.png') }}">
    </head>
    <body>
        @include('layouts.navbar')

        @yield('content')

        @include('layouts.footer')


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112938427-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-112938427-1');
        </script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".navbar-toggle").click(function(e){
                    $("i", this).toggleClass("fa-chevron-left fa-times");
                    $(this).toggleClass("open");
                    $(".navbar").toggleClass("open");
                    e.preventDefault();
                    
                });
                /*
                setTimeout(function(){
                    $(".intro-fox").toggleClass('move');
                    $(".intro-panda").toggleClass('move');
                },300);
                */
            });
        </script>
    </body>
</html>