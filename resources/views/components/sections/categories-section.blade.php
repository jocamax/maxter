<section class="bg-white" role="region" aria-labelledby="kategorije-naslov">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-10">
            <h2 id="kategorije-naslov" class="text-2xl font-bold text-gray-900">Kategorije proizvoda</h2>

            <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:space-y-0 lg:gap-x-6" role="list">
                <!-- KARTICA 1 -->
                <article class="group relative" role="listitem" itemscope itemtype="https://schema.org/CollectionPage">
                    <a href="{{ route('products.getMasineZaFarb', ['category' => 'airless']) }}"
                       class="block focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 rounded-lg"
                       aria-label="Mašine za farbanje i gletovanje — pogledaj proizvode" itemprop="url">
                        <img
                            src="{{ asset('storage/photos/m500.jpg') }}"
                            alt="Airless mašina za farbanje i gletovanje — model MT500"
                            class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square"
                            loading="lazy" decoding="async"
                            sizes="(max-width: 640px) 100vw, (max-width: 1024px) 33vw, 24rem"
                        />
                        <h3 class="mt-4 text-sm text-white">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                        </h3>
                        <p class="text-base font-semibold text-gray-900" itemprop="name">
                            Mašine za farbanje i gletovanje
                        </p>
                    </a>
                </article>

                <!-- KARTICA 2 -->
                <article class="group relative" role="listitem" itemscope itemtype="https://schema.org/CollectionPage">
                    <a href="{{ route('products.getMasineZaPesk') }}"
                       class="block focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 rounded-lg"
                       aria-label="Mašine za peskarenje — pogledaj proizvode" itemprop="url">
                        <img
                            src="https://masineshop.com/wp-content/uploads/2025/08/1.1-LtWbZOis-1692x2048.png"
                            alt="Profesionalna mašina za peskarenje — industrijski model"
                            class="w-full rounded-lg bg-white object-cover shadow-md group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square"
                            loading="lazy" decoding="async"
                            sizes="(max-width: 640px) 100vw, (max-width: 1024px) 33vw, 24rem"
                        />
                        <h3 class="mt-4 text-sm text-gray-500">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                        </h3>
                        <p class="text-base font-semibold text-gray-900" itemprop="name">
                            Mašine za peskarenje
                        </p>
                    </a>
                </article>

                <!-- KARTICA 3 -->
                <article class="group relative" role="listitem" itemscope itemtype="https://schema.org/CollectionPage">
                    <a href="{{ route('products.index', ['category' => 'ostalo']) }}"
                       class="block focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 rounded-lg"
                       aria-label="Pištolji, dizne i rezervni delovi — pogledaj proizvode" itemprop="url">
                        <img
                            src="{{ asset('storage/photos/pistolj.png') }}"
                            alt="Pištolj za farbanje sa diznama — profesionalna oprema"
                            class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square shadow-md"
                            loading="lazy" decoding="async"
                            sizes="(max-width: 640px) 100vw, (max-width: 1024px) 33vw, 24rem"
                        />
                        <h3 class="mt-4 text-sm text-gray-500">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                        </h3>
                        <p class="text-base font-semibold text-gray-900" itemprop="name">
                            Pištolji, dizne i ostali rezervni delovi
                        </p>
                    </a>
                </article>
            </div>
        </div>
    </div>
</section>
