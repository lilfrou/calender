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
                                        <h3 class="block-title">{{ __('auth.Reset Password')}}</h3>
                                        <div class="block-options">
                                            @if (Route::has('password.request'))
                                                <a class="btn-block-option font-size-sm" href="{{ route('login') }}">
                                                    {{ __('auth.Already Registered?')}}
                                                </a>
                                            @endif
                                            {{-- <a class="btn-block-option font-size-sm" href="op_auth_reminder.html">Forgot Password?</a> --}}
                                            <a class="btn-block-option" href="{{ route('register') }}" data-toggle="tooltip" data-placement="left" title="New Account">
                                                <i class="fa fa-user-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="p-sm-3 px-lg-4 py-lg-5">
                                            <h1 class="mb-2">{{ __('auth.Account Book Module')}}</h1>
                                            <p>{{ __('auth.Please, enter registered email.')}}</p>

                                            <!-- Sign In Form -->
                                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                            <form class="js-validation-signin" action="{{ route('password.email') }}" method="POST">
                                                @csrf
                                                <div class="py-3">
                                                    <div class="form-group">
                                                        <input id="email" type="email" class="form-control form-control-alt form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.Registered Email')}}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ __('auth.'.$errors->first('email')) }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-xl-12">
                                                        <button type="submit" class="btn btn-block btn-primary">
                                                            {{ __('auth.Send Password Reset Link') }}
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
                        <strong>{{ __('auth.By Account Book Module')}}</strong>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
@endsection

