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
                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown"
                        data-timeout="300">
                        {{trans('auth.Please validate your Email to unlock dashboard')}}
                    </h2>
                    <a class="btn btn-outline-danger mb-1 mr-1" href="{{route('logout')}}"
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
        <script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },10000);
    </script>
    <!-- END Hero -->
@endsection
