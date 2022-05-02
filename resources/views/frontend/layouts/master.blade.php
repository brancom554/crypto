<!doctype html>
<html lang="{{ htmlLang() }}" @rtl dir="rtl" @endrtl>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($page_title ?? '') }}</title>
    @include('partials.seo')
    <link rel="shortcut icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}">
    @yield('meta')

    @stack('before-styles')
    <!-- App favicon -->

    @stack('before-styles')
    <link href="{{ mix('css/frontend/app.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>
<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    @yield('layout')

    @include('includes.partials.messages')

    @stack('before-scripts')
    <script src="{{ mix('js/frontend/manifest.js') }}"></script>
    <script src="{{ mix('js/frontend/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend/app.js') }}"></script>
    @stack('after-scripts')
</body>
</html>
