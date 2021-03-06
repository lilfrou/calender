@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                        {{trans('auth.calender')}}
                    </h1>
                    @if(Auth::user()->auth==='admin' || (Auth::user()->auth==='operator' && Auth::user()->zoom_user_status==='active'))
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown"
                        data-timeout="300">
                        {{trans('auth.Please link your Zoom account')}}
                    </h2>
                    @else
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown"
                    data-timeout="300">
                    {{trans('auth.Please link your sub zoom account')}}
                </h2>
                @endif
                    <a class="btn btn-outline-danger mb-1 mr-1" href="{{route('logout')}}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span>{{trans('auth.Logout')}}</span>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <i class="si si-logout ml-1"></i>
                </a>
                @if(Auth::user()->auth==='admin' || (Auth::user()->auth==='operator' && Auth::user()->zoom_user_status==='active'))
                <a href="{{route('api.getCode')}}" class="btn btn-outline-info mb-1 mr-1">Link<i class="si si-logout ml-1"></i></a>
                @else
                <a href="{{route('api.createSubUser')}}" class="btn btn-outline-info mb-1 mr-1">get sub zoom account user<i class="si si-logout ml-1"></i></a>

                @endif


                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
