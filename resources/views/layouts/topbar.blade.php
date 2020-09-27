<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
        </button>

        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Open Search Section (visible on smaller screens) -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
             {{-- <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout"
                data-action="header_search_on">
                <i class="si si-magnifier"></i>
            </button> --}}
            <!-- END Open Search Section -->

            <!-- Search Form (visible on larger screens) -->
            {{-- <form class="d-none d-sm-inline-block" action="/dashboard" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="{{__('a.search')}}"
                        id="page-header-search-input2" name="page-header-search-input2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-body border-0">
                            <i class="si si-magnifier"></i>
                        </span>
                    </div>
                </div>
            </form> --}}
            <!-- END Search Form -->

        </div>
        <!-- END Left Section -->


        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="btn btn-sm btn-dual">{{Auth::user()->name}}</span>
                    {{-- <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->name}}</span> --}}
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-2">

                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span>{{trans('auth.Logout')}}</span>
                            <i class="si si-logout ml-1"></i>
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
