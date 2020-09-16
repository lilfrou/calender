@extends('layouts.simple')

@section('content')

<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('assets/media/photos/photo6@2x.jpg');">
            <div class="hero-static bg-white-95">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <!-- Sign In Block -->
                            <div class="block block-themed block-fx-shadow mb-0">
                                <div class="block-header">
                                    <h3 class="block-title">{{ __('auth.Sign In')}}</h3>
                                    <div class="block-options">
                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn-block-option font-size-sm" href="{{ route('password.request') }}">
                                                {{ __('auth.Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                        <a class="btn-block-option" href="{{ route('register') }}" data-toggle="tooltip" data-placement="left" title="{{ __('auth.New Account')}}">
                                            <i class="fa fa-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 py-lg-5">
                                        <h1 class="mb-2">{{ __('auth.Calender')}}</h1>
                                        <p>{{ __('auth.Welcome, please login.')}}</p>
                                        <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input id="email" type="email" class="form-control form-control-alt form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.Email')}}" required autofocus>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __('auth.'.$errors->first('email')) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input id="password" type="password" class="form-control form-control-alt form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('auth.Password')}}" required>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __('auth.'.$errors->first('password')) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-xl-6">
                                                    <button type="submit" class="btn btn-block btn-primary">
                                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('auth.Sign In')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END Sign In Form -->

                                    </div>
                                </div>
                            </div>
                            <!-- END Sign In Block -->

                        </div>
                    </div>
                </div>
                <div class="content content-full font-size-sm text-muted text-center">
                    <strong>{{ __('auth.By Calender')}}</strong>
                </div>
            </div>
        </div>
        <!-- END Page Content -->

    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

@endsection
