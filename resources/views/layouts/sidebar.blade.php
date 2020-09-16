
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

</nav>
