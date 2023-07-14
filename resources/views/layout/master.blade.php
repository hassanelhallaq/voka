<!DOCTYPE html>
@php
    $language = session()->get('lang');
@endphp
@if ($language == 'ar')
    <html lang="en" dir="rtl" direction="rtl" style="direction:rtl;">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ printHtmlAttributes('html') }}>
@endif

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <base href="" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <link rel="canonical" href="" />

    {!! includeFavicon() !!}

    <!--begin::Fonts-->
    {!! includeFonts() !!}
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->


    <!--end::Global Stylesheets Bundle-->

    @if ($language == 'ar')

        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <!--end::Page Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <!--end::Custom Stylesheets-->
    @else
        @foreach (getGlobalAssets('css') as $path)
            {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
        @endforeach
        <!--begin::Vendor Stylesheets(used by this page)-->
        @foreach (getVendors('css') as $path)
            {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
        @endforeach
        <!--end::Vendor Stylesheets-->

        <!--begin::Custom Stylesheets(optional)-->
        @foreach (getCustomCss() as $path)
            {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
        @endforeach
    @endif



</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" {!! printHtmlClasses('body') !!} {!! printHtmlAttributes('body') !!}>

    {{-- @include('partials/theme-mode/_init') --}}

    @yield('content')

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    @foreach (getGlobalAssets() as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used by this page)-->
    @foreach (getVendors('js') as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(optional)-->
    @foreach (getCustomJs() as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

</body>
<!--end::Body-->

</html>
