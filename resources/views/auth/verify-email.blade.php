{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <div class="mb-4 text-sm text-gray-600">--}}
{{--            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}--}}
{{--        </div>--}}

{{--        @if (session('status') == 'verification-link-sent')--}}
{{--            <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--                {{ __('A new verification link has been sent to the email address you provided during registration.') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="mt-4 flex items-center justify-between">--}}
{{--            <form method="POST" action="{{ route('verification.send') }}">--}}
{{--                @csrf--}}

{{--                <div>--}}
{{--                    <x-primary-button>--}}
{{--                        {{ __('Resend Verification Email') }}--}}
{{--                    </x-primary-button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}

{{--                <button type="submit"--}}
{{--                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}


        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Confirm Email | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">

</head>

<body class="authentication-bg" data-layout-config='{"darkMode":false}'>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="{{ asset('images/logo/logo-vnext-white-2019.png') }}" alt=""
                                       height="60"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center m-auto">
                            <img src="{{ asset('images/mail_sent.svg') }}" alt="mail sent image" height="64"/>
                            <h4 class="text-dark-50 text-center mt-4 font-weight-bold">Please check your email</h4>
                            <p class="text-muted mb-4">
                                Thanks for signing up! A email has been send to <b>{{ auth()->user()->email }}</b>.
                                Before getting started, could you verify your email address by
                                clicking on the link we just emailed to you? If you didn't receive the email, we will
                                gladly send you another.
                            </p>
                        </div>


                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="form-group text-center">
                                <button type="submit"
                                        class="btn btn-primary btn-block waves-effect waves-light">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="form-group text-center">
                                <button class="btn btn-danger">
                                    Logout
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div> <!-- end card-body-->
        </div>
        <!-- end card-->

    </div> <!-- end col -->
</div>
<!-- end row -->
</div>
<!-- end container -->
</div>
<!-- end page -->

{{--<footer class="footer footer-alt">--}}
{{--    2018 - 2020 © Hyper - Coderthemes.com--}}
{{--</footer>--}}

<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>

</body>
</html>
