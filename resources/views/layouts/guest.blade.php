<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?: 'sr-RS') }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Maxter') }}</title>

        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@yield('title', config('app.name', 'Maxter') . ' - mašine za farbanje, gletovanje i peskarenje')</title>
        <meta name="description" content="@yield('meta_description','Profesionalne airless mašine i prateća oprema. Brza isporuka, garancija i servis u Srbiji.')">
        <link rel="canonical" href="@yield('canonical', url()->current())">
        <meta name="robots" content="@yield('robots','index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1')">
        <meta name="google-site-verification" content="VBMgGvi5Rn2AvArLq2Ce4aCPxBAMIOEjWSN-7AyBosc" />
        <meta property="og:locale" content="sr_RS">
        <meta property="og:type" content="@yield('og_type','website')">
        <meta property="og:site_name" content="{{ config('app.name','Maxter') }}">
        <meta property="og:title" content="@yield('og_title', View::getSections()['title'] ?? (config('app.name','Maxter')))">
        <meta property="og:description" content="@yield('og_description', View::getSections()['meta_description'] ?? 'Profesionalne airless mašine i oprema.')">
        <meta property="og:url" content="@yield('og_url', url()->current())">
        <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
        <meta property="og:image:alt" content="@yield('og_image_alt','Maxter — ilustracija za deljenje')">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('twitter_title', View::getSections()['title'] ?? (config('app.name','Maxter')))">
        <meta name="twitter:description" content="@yield('twitter_description', View::getSections()['meta_description'] ?? 'Profesionalne airless mašine i oprema.')">
        <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
