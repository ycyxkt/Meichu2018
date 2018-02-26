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

        <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-M5ZJ5KR');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M5ZJ5KR"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include('layouts.navbar')

        @yield('content')

        @include('layouts.footer')


        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".navbar-toggle").click(function(e){
                    $("i", this).toggleClass("fa-chevron-left fa-times");
                    $(this).toggleClass("open");
                    $(".navbar").toggleClass("open");
                    e.preventDefault();
                    
                });
                
                setTimeout(function(){
                    $(".intro-fox").toggleClass('move');
                    $(".intro-panda").toggleClass('move');
                },300);
                
            });
        </script>
        @yield('custom_script')
    </body>
</html>