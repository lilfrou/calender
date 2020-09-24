
<nav id="sidebar" aria-label="Main Navigation">

    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="{{route('dashboard')}}">
            <span class="smini-hide">
                <span class="font-w700 font-size-h5">{{trans('auth.Calender')}}</span>
            </span>
        </a>
    </div>

    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{request()->is('dashboard') ? ' active' : ''}}" href="{{route('dashboard')}}">
                    <i class="nav-main-link-icon far fad fa-calendar-alt"></i>
                    <span class="nav-main-link-name">dashboard</span>
                </a>
            </li>
        </ul>
    </div>
    @if(Auth::user()->auth=='admin')
    <span class="nav-main-heading">user_setting</span>

    <li class="nav-main-item{{request()->is('user/*')  ? ' open' : ''}}">

        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
            aria-expanded="true" href="#">
            <i class="nav-main-link-icon si si-user"></i>
            <span class="nav-main-link-name">users</span>
        </a>

        <ul class="nav-main-submenu">

            <li class="nav-main-item">
                <a class="nav-main-link{{request()->is('user/admin') ? ' active' : ''}}"
                    href="{{route('user.index', 'admin')}}">
                    <i class="nav-main-link-icon si si-user"></i>
                    <span class="nav-main-link-name">admins</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{request()->is('user/operator') ? ' active' : ''}}"
                    href="{{route('user.index', 'operator')}}">
                    <i class="nav-main-link-icon si si-user"></i>
                    <span class="nav-main-link-name">operators</span>
                    <span class="badge badge-pill badge-secondary">
                        {{-- {{$service->getAuthUsers('guest')->count()}} --}}
                    </span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{request()->is('user/guest') ? ' active' : ''}}"
                    href="{{route('user.index', 'guest')}}">
                    <i class="nav-main-link-icon si si-user"></i>
                    <span class="nav-main-link-name">guests</span>
                    <span class="badge badge-pill badge-secondary">
                        {{-- {{$service->getAuthUsers('guest')->count()}} --}}
                    </span>
                </a>
            </li>

        </ul>
    </li>
    @endif
</nav>
