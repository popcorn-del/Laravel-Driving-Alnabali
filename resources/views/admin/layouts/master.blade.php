<!doctype html>
<html dir="{{ app()->getLocale() === 'jor' ? 'rtl' : 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) === 'jor' ? 'ar' : 'en' }}" class="translated-rtl">
<head>
    <meta charset="utf-8" />
    <title> ALNABALI | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    <style>
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }
    body {
        top: 0px !important;
    }
    .text-capitalize {
        text-transform: capitalize;
    }
    </style>
    @if (app()->getLocale() === 'jor')
    <style>
        #page-topbar {
            left: 0 !important;
            right: 240px !important;
        }
        .main-content {
            margin-right: 250px !important;
            margin-left: 0px !important
        }
    </style>
    @endif
    @include('admin.layouts.head-css')
</head>

@section('body')
    <body data-sidebar="dark">
@show

    {{-- <div id="google_translate_element"></div>
    <script type="text/javascript">
        var seletedLanguage = "{{ str_replace('_', '-', app()->getLocale()) === 'jor' ? 'ar' : 'en' }}";
        function googleTranslateElementInit() {
            setCookie('googtrans', '/en/' + seletedLanguage, 1);
            new google.translate.TranslateElement({ pageLanguage: 'ES', layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
        }
        function setCookie(key, value, expiry) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }
    </script> --}}

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('admin.layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('admin.layouts.vendor-scripts')
</body>

</html>
