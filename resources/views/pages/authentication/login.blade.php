@php
    $title = 'Login Page';
    $description = 'Login Page'
@endphp
@extends('layout_full',[
'title'=>$title,
'description'=>$description
])
@section('css')
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('js_vendor')
    <script src="{{ asset('/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
@endsection

@section('js_page')
    <script src="{{ asset('/js/pages/auth.login.js') }}"></script>
@endsection

@section('content_left')

@endsection

@section('content_right')
    <div
        class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="sh-11">
                <a href="{{ url('/') }}">

                </a>
            </div>

            <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">Welcome,</h2>
                <h2 class="cta-1 text-primary">To The LAVEMS New Portal</h2>

            </div>
            <div class="mb-5">
                <p class="h6">Please use your credentials to login.</p>

            </div>
            <div>


                <form id="login-form">
                    @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-cs-icon="email"></i>
                        <input class="form-control" placeholder="Email" name="email" id="email" />
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-cs-icon="lock-off"></i>
                        <input class="form-control pe-7" name="password" type="password" placeholder="Password" id="password" />
                        <a class="text-small position-absolute t-3 e-3" href="{{ url('/Pages/Authentication/ForgotPassword') }}">Forgot?</a>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary" id="login-btn">Login</button>
                    {{-- <button type="submit" class="btn btn-lg btn-primary" id="login-btn" onclick="this.innerHTML='Please wait...'; this.disabled=true; ">Login</button> --}}

                </form>

                <script src="{{ asset('js/auth.js') }}"></script>





            </div>
        </div>
    </div>
@endsection
