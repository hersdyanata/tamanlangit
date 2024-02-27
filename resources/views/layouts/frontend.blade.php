<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/phosphor/styles.min.css') }}">
        <link rel="icon" href="{{ asset('assets/fe/img/favicon-100x100.png') }}" type="image/x-icon">
        <title>{{ ENV('APP_NAME') }}</title>
    </head>

    <body>
        <div class="mil-wrapper">
            <div class="mil-loader mil-active">
                <div class="mil-loader-content">
                    <div class="mil-loader-logo">
                        <img src="{{ asset('assets/fe/img/logo-tl.png') }}" alt="Logo">
                    </div>
                    <div class="mil-loader-progress">
                        <div class="mil-loader-bar"></div>
                        <div class="mil-loader-percent">0%</div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div class="mil-progressbar"></div>

        </div>
        <script src="{{ asset('assets/fe/js/plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/smooth-scroll.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/swiper.min.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/datepicker.js') }}"></script>
        <script src="{{ asset('assets/fe/js/main.js') }}"></script>
    </body>

</html>
