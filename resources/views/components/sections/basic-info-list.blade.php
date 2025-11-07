<section aria-labelledby="perks-heading" class="border-t border-gray-200 bg-gray-50" itemscope itemtype="https://schema.org/ItemList">
    <!-- vidljiv naslov je opcionalan; sr-only je ok radi dizajna -->
    <h2 id="perks-heading" class="sr-only" itemprop="name">Prednosti Maxter ponude</h2>

    <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
        <div class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-0" role="list">

            <!-- Perk 1 -->
            <article class="text-center md:flex md:items-start md:text-left lg:block lg:text-center" role="listitem" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">
                <meta itemprop="position" content="1" />
                <div class="md:shrink-0">
                    <div class="flow-root">
                        <img src="{{ asset('storage/photos/guarantee-icon.png') }}"
                             alt=""
                             role="presentation"
                             class="mx-auto -my-1 h-24 w-auto"
                             loading="lazy" decoding="async" />
                    </div>
                </div>
                <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0" itemprop="item" itemscope itemtype="https://schema.org/Thing">
                    <h3 class="text-base font-medium text-gray-900" itemprop="name">2 godine garancije</h3>
                    <p class="mt-3 text-sm text-gray-500" itemprop="description">Uz sve naše mašine dolazi garancija u trajanju od 2 godine.</p>
                </div>
            </article>

            <!-- Perk 2 -->
            <article class="text-center md:flex md:items-start md:text-left lg:block lg:text-center" role="listitem" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">
                <meta itemprop="position" content="2" />
                <div class="md:shrink-0">
                    <div class="flow-root">
                        <img src="{{ asset('storage/photos/configuration-icon.png') }}"
                             alt=""
                             role="presentation"
                             class="mx-auto -my-1 h-24 w-auto"
                             loading="lazy" decoding="async" />
                    </div>
                </div>
                <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0" itemprop="item" itemscope itemtype="https://schema.org/Thing">
                    <h3 class="text-base font-medium text-gray-900" itemprop="name">Servis i rezervni delovi</h3>
                    <p class="mt-3 text-sm text-gray-500" itemprop="description">Servisiramo sve naše mašine i obezbeđujemo kompletan asortiman rezervnih delova.</p>
                </div>
            </article>

            <!-- Perk 3 -->
            <article class="text-center md:flex md:items-start md:text-left lg:block lg:text-center" role="listitem" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">
                <meta itemprop="position" content="3" />
                <div class="md:shrink-0">
                    <div class="flow-root">
                        <img src="{{ asset('storage/photos/info-map-location-icon.png') }}"
                             alt=""
                             role="presentation"
                             class="mx-auto -my-1 h-24 w-auto"
                             loading="lazy" decoding="async" />
                    </div>
                </div>
                <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0" itemprop="item" itemscope itemtype="https://schema.org/Thing">
                    <h3 class="text-base font-medium text-gray-900" itemprop="name">Obuka i puštanje u rad</h3>
                    <p class="mt-3 text-sm text-gray-500" itemprop="description">Organizujemo besplatnu obuku i puštanje u rad za odabrane mašine.</p>
                </div>
            </article>

            <!-- Perk 4 -->
            <article class="text-center md:flex md:items-start md:text-left lg:block lg:text-center" role="listitem" itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">
                <meta itemprop="position" content="4" />
                <div class="md:shrink-0">
                    <div class="flow-root">
                        <img src="{{ asset('storage/photos/delivery-truck-icon.png') }}"
                             alt=""
                             role="presentation"
                             class="mx-auto -my-1 h-24 w-auto"
                             loading="lazy" decoding="async" />
                    </div>
                </div>
                <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0" itemprop="item" itemscope itemtype="https://schema.org/Thing">
                    <h3 class="text-base font-medium text-gray-900" itemprop="name">Besplatna dostava</h3>
                    <p class="mt-3 text-sm text-gray-500" itemprop="description">Brzi rokovi isporuke širom Srbije.</p>
                </div>
            </article>

        </div>
    </div>
</section>
