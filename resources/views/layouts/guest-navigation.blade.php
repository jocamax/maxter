<nav x-data="{ open: false }"
     class="bg-white border-b border-gray-100"
     role="navigation"
     aria-label="Primary"
     itemscope itemtype="https://schema.org/SiteNavigationElement">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" rel="home" aria-label="Početna — Maxter">
                        <img
                            class="block h-16 w-16 fill-current"
                            src="{{ asset('storage/photos/logozasajt2.png') }}"
                            alt="Maxter logo"
                            width="128" height="64"
                            decoding="async"
                            fetchpriority="high"
                        />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" itemprop="url">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" itemprop="url">
                        {{ __('Proizvodi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" itemprop="url">
                        {{ __('Kontakt') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Contact -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="tel:+381666611999" class="text-gray-700 hover:text-gray-900" aria-label="Pozovi Maxter">

                </a>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    :aria-expanded="open.toString()"
                    aria-controls="mobile-primary-nav"
                    aria-label="Toggle menu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div id="mobile-primary-nav" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Na mobilu ponovi glavne linkove (SEO + UX); uklonjen "Dashboard" iz javne navigacije --}}
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" itemprop="url">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" itemprop="url">
                {{ __('Proizvodi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" itemprop="url">
                {{ __('Kontakt') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options (po potrebi, ostavljeno) -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                {{--  <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                      <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div> --}}
            </div>

            <div class="mt-3 space-y-1">
       
            </div>
        </div>
    </div>
</nav>
