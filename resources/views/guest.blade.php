@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{asset('media/photos/photo36@2x.jpg')}}');">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w600 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                        {{trans('auth.calender')}}
                    </h1>
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown"
                        data-timeout="300">
                        {{trans('auth.Waiting for approve from Admin')}}
                    </h2>
                    <a class="" href="{{route('logout')}}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span>{{trans('auth.Logout')}}</span>

                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <i class="si si-logout ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
