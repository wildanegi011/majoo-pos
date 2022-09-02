<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>
        {{ config('app.name') }} | @yield('subtitle', 'Login')
    </title>
    <meta name="description" content="progresio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ asset('vendor/metronic-3/css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/metronic-3/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/metronic-3/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @stack('stylesheet')
    <link rel="shortcut icon" href="{{ asset(config('partner.config.icon.main')) }}" />
</head>

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                style="background-image: url({{ asset('vendor/metronic-3/media/bg/bg-2.jpg') }});">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#2c77f4",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <script src="{{ asset('vendor/metronic-3/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/metronic-3/js/scripts.bundle.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('vendor/metronic-3/js/pages/custom/login/login-general.js') }}" type="text/javascript"></script> --}}
    @stack('script')
</body>

</html>
