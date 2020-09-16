<!doctype html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>

    <title>{{trans('auth.Calender')}}</title>

    <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{asset('media/favicons/favicon.png')}}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{asset('media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicons/apple-touch-icon-180x180.png')}}">

    <!-- Fonts and Styles -->
    @yield('css_before')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link rel="stylesheet" id="css-main" href="{{asset('css/oneui.css')}}">
    <link rel="stylesheet" id="css-main" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('dist/dropzone.css')}}">
    {{-- <script src="{{asset('dist/dropzone.js')}}"></script>
    <script src="{{asset('dist/min/dropzone.min.js')}}"></script> --}}

    @yield('css_after')

    {{-- <script>
        window.Laravel = {
            !!json_encode(['csrfToken' => csrf_token(), ]) !!
       }}}
    </script> --}}
</head>

<body>
    <!-- Page Container -->
    <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed">
        <!-- Side Overlay-->
        <aside id="side-overlay" class="font-size-sm">
            <!-- Side Header -->
            <div class="content-header border-bottom">
                <!-- User Avatar -->
                <a class="img-link mr-1" href="javascript:void(0)">
                    <img class="img-avatar img-avatar32" src="{{asset('media/avatars/avatar10.jpg')}}" alt="">
                </a>
                <!-- END User Avatar -->

                <!-- User Info -->
                <div class="ml-2">
                    <a class="link-fx text-dark font-w600" href="javascript:void(0)">{{__('a.user_name_example')}}</a>
                </div>
                <!-- END User Info -->

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="ml-auto btn btn-sm btn-dual" href="javascript:void(0)" data-toggle="layout"
                    data-action="side_overlay_close">
                    <i class="fa fa-fw fa-times text-danger"></i>
                </a>
                <!-- END Close Side Overlay -->
            </div>
            <!-- END Side Header -->
        </aside>

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- END Sidebar -->


        <!-- Header -->
        @include('layouts.topbar')
        <!-- END Header -->


        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->


        <!-- Footer -->
        @include('layouts.footer')
        <!-- END Footer -->

    </div>
    <!-- END Page Container -->

    <!-- OneUI Core JS -->
    <script src="{{asset('js/oneui.app.js')}}"></script>

    <!-- Laravel Scaffolding JS -->
    @yield('js_after')

</body>

</html>
