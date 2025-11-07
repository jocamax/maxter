<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?: 'sr-RS') }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO CORE (override po stranici sa @section) --}}
    <title>@yield('title', config('app.name', 'Maxter') . ' - mašine za farbanje, gletovanje i peskarenje')</title>
    <meta name="description" content="@yield('meta_description','Profesionalne airless mašine i prateća oprema. Brza isporuka, garancija i servis u Srbiji.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="robots" content="@yield('robots','index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1')">

    {{-- Open Graph / Twitter --}}
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
    @auth
        <meta name="robots" content="noindex, nofollow">
    @endauth
    {{-- Favicons (postavi svoje putanje) --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Preconnect/Fonts (ostavljeno tvoje bunny.net) --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- (Opc.) hreflang ako imaš više jezika --}}
    @stack('hreflang')

    {{-- JSON-LD per stranica (ubaci sa @section('jsonld')) --}}
    @yield('jsonld')

    {{-- tvoj x-cloak stil bio je izvan <head>; premešten je ovde (valid HTML) --}}
    <style>[x-cloak]{ display:none !important; }</style>

    {{-- Scripts/CSS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased">
{{-- Skip link radi pristupačnosti (ne utiče na tvoj CSS layout) --}}
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:bg-white focus:px-3 focus:py-2 focus:rounded">
    Preskoči na sadržaj
</a>

<div class="min-h-screen bg-white">
    @auth
        @include('layouts.navigation')
    @endauth

    @guest
        @include('layouts.guest-navigation')
    @endguest

    {{-- Page Heading (opciono) --}}
    @isset($header)
        <header class="bg-white shadow" role="banner">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Page Content --}}
    <main id="main-content" role="main">
        {{ $slot }}

        <footer class="bg-white" role="contentinfo">
            <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
                <nav aria-label="Footer" class="-mb-6 flex flex-wrap justify-center gap-x-12 gap-y-3 text-sm/6">
                    <a href="/" class="text-gray-600 hover:text-gray-900">Početna</a>
                    <a href="/products" class="text-gray-600 hover:text-gray-900">Proizvodi</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">O nama</a>
                    <a href="/contact" class="text-gray-600 hover:text-gray-900">Kontakt</a>
                </nav>
                <p class="mt-10 text-center text-sm/6 text-gray-600">&copy; {{ now()->year }} Maxter, © Copyright.</p>
            </div>
        </footer>
    </main>
</div>

@stack('scripts')
</body>
</html>
