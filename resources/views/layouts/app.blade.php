<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ env('APP_NAME') }} @yield('subtitle')</title>

        <!-- Global stylesheets -->
        <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
        <link rel="icon" href="{{ asset('assets/fe/img/favicon-100x100.png') }}" type="image/x-icon">
        <!-- /global stylesheets -->
        
        <!-- Core JS files -->
        <script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <!-- /core JS files -->
        
        <!-- Vendor -->
        <script src="{{ asset('assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
        <!-- /Vendor -->
        
        @yield('page_resources')
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </head>

    <body>
        @include('includes.navbar')
        <!-- Page content -->
        <div class="page-content">
            @include('includes.sidebar')
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Inner content -->
                <div class="content-inner">
                    {{-- @include('includes.breadcrumb') --}}
                    <!-- Content area -->
                    <div class="content">
                        @yield('content')
                    </div>
                    <!-- /content area -->

                    @include('includes.footer')
                </div>
                <!-- /inner content -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
        @include('includes.switcher')
        @include('includes.notifications')
    </body>

    @yield('page_js')
</html>