<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('head')
        <link rel="stylesheet" href="/css/app.css">
        {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}

        <title>Treasury</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

    </head>
    <body>
        <header role="banner" data-feature="header" data-type="b" data-header-transition-override=""> <!-- Try to figure out how to make a banner -->
            <h1 class="golden-title"><a href="/periods"><img id="flag" src="/img/crown.png" width="81" height="54" class="crown"></a>Treasury of the King</h1>
        </header>

        <div class="content-margin-top">
        @yield('content')
        @yield('footer')
        </div>
        @yield('onload')
    </body>
</html>
