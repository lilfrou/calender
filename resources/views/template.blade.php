@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">

        {{-- Alert Positive --}}
        @if(session('positive'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{__('alert.'.session('positive'))}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Alert Negative --}}
        @if(session('negative'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{__('alert.'.session('negative'))}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">

                    @yield('header')

                    <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">
                        @yield('small-header')
                    </small>

                    <div class="float-right">
                        @yield('header-btn')
                    </div>

                </h1>
                @yield('navi-filter')
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        @yield('filter-format')

        <!-- Your Block -->
        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">

                    @yield('title')

                    <div class="float-right">
                        @yield('title-btn')
                    </div>

                </h3>
            </div>

            <div class="block-content">
                <p class="font-size-sm text-muted">
                    @yield('body')
                </p>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->

    <script>

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);

    </script>

@endsection
