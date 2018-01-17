<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - 戊戌梅竹 Meichu2018</title>
        
    </head>
    <body>
        @include('layouts.navbar')

        @yield('content')

        @include('layouts.footer')
    </body>
</html>