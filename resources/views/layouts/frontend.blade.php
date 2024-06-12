<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @yield('meta_data')

        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/plugins/datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fe/css/loader.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/phosphor/styles.min.css') }}">
        <link href="{{ asset('assets/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
        @yield('page_css')
        <link rel="icon" href="{{ asset('assets/fe/img/favicon-100x100.png') }}" type="image/x-icon">
        <title>{{ ENV('APP_NAME') }} @yield('subtitle')</title>

        <style>
            .star-review {
                color: rgb(259, 245, 28);
            }

            .wab{
                position:fixed;
                width:60px;
                height:60px;
                bottom:40px;
                right:40px;
                background-color:#25d366;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                font-size:30px;
                box-shadow: 2px 2px 3px #999;
                z-index:9999;
            }

            .wab-float{
                margin-top:16px;
            }
        </style>

    </head>

    <body>
        <div class="mil-wrapper">            
            {{-- <div class="mil-loader mil-active">
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
            <div class="mil-progressbar"></div> --}}

            @include('frontends.home.elements.topbar')

            @yield('content')
            @include('frontends.home.elements.footer')
            @include('frontends.home.elements.book_popup')

            @php
                $contact = getContact();
            @endphp
            
            <a href="https://wa.me/{{ $contact->mobile_number }}" class="wab" target="_blank">
                <i class="ph-whatsapp-logo ph-2x wab-float"></i>
            </a>
        </div>

        <script src="{{ asset('assets/fe/js/plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/smooth-scroll.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/swiper.min.js') }}"></script>
        <script src="{{ asset('assets/fe/js/plugins/datepicker.js') }}"></script>

        <script src="{{ asset('assets/fe/js/main.js') }}"></script>
        @yield('page_resources')
        @yield('page_js')

        <script>
            let buttonClass = 'btn-launch-spinner';
            let containerClass = 'mil-wrapper';
            let containerClass2 = 'mil-info';
            let overlayClass = 'card-overlay';
            let overlayAnimationClass = 'card-overlay-fadeout';

            let overlayElement;

            function openLoader() {
                document.querySelectorAll(`.${buttonClass}`).forEach(function(button) {
                    let parentContainer = button.closest(`.${containerClass}`);
                    overlayElement = document.createElement('div');
                    let overlayElementIcon = document.createElement('span');

                    overlayElement.classList.add(overlayClass);
                    parentContainer.appendChild(overlayElement);
                    if (button.getAttribute('data-spin') == 'false') {
                        overlayElementIcon.classList.add(button.getAttribute('data-icon'));
                    } else {
                        overlayElementIcon.classList.add(button.getAttribute('data-icon'), 'spinner', 'ph-5x');
                    }

                    overlayElement.appendChild(overlayElementIcon);
                });
            }

            function closeLoader() {
                if (overlayElement) {
                    overlayElement.classList.add(overlayAnimationClass);
                    overlayElement.addEventListener('animationend', function() {
                        overlayElement.remove();
                        overlayElement = null;
                    });
                    overlayElement.addEventListener('animationcancel', function() {
                        // overlayElement.remove();
                        overlayElement = null;
                    });
                } else {
                    console.warn('overlayElement tidak ditemukan.');
                }
            }

        </script>
    </body>
</html>