<x-app-layout>
    <div class="bg-white p-5">
        <div class="mx-auto max-w-2xl px-4 py-6 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">

            <div class="flex items-center justify-between flex-wrap gap-3">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Proizvodi</h1>

                <form method="GET" class="flex items-center flex-wrap gap-3" role="search" aria-label="Filtriranje i sortiranje proizvoda">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="price_sort" class="text-sm text-gray-700">Sortiraj po</label>
                        <select id="price_sort" name="price_sort"
                                class="w-48 rounded-md border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                onchange="this.form.submit()">
                            <option value="asc"  @selected(request('price_sort','asc')==='asc')>Rastućoj ceni</option>
                            <option value="desc" @selected(request('price_sort')==='desc')>Opadajućoj ceni</option>
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="category" class="sr-only">Kategorija</label>
                        <select id="category" name="category"
                                class="w-56 rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
                            <option value="">Sve kategorije</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                            @endforeach
                        </select>

                        <button class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
                                aria-label="Primeni filtere">
                            Potvrdi
                        </button>
                    </div>

                    @if(request('category'))
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-gray-800"
                           aria-label="Obriši filter kategorije">
                            Obriši
                        </a>
                    @endif
                </form>

                @auth
                    <a href="{{ route('products.create') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        New Product
                    </a>
                @endauth>
            </div>

            {{-- (opciono) brojač rezultata radi UX-a: --}}
            {{-- <p class="mt-2 text-sm text-gray-600" aria-live="polite">{{ $products->total() }} proizvoda</p> --}}

        </div>

        <div class="mt-6 grid grid-cols-1 max-w-7xl m-auto gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
             role="list"
             itemscope
             itemtype="https://schema.org/ItemList">

            @forelse ($products as $index => $p)
                <article class="group relative"
                         role="listitem"
                         itemscope
                         itemtype="https://schema.org/Product"
                         itemprop="itemListElement">
                    {{-- ItemList pozicija (1-based) --}}
                    <meta itemprop="position" content="{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}" />

                    <a href="{{ route('products.show', $p->id) }}" class="block" aria-label="Pogledaj proizvod: {{ $p->title }}" itemprop="url">
                        <div class="aspect-square w-full overflow-hidden rounded-md bg-white shadow-md">
                            @php $img = $p->images->first(); @endphp

                            @if($img)
                                <img
                                    src="{{ asset('storage/'.$img->path) }}"
                                    alt="{{ $p->title }} — fotografija proizvoda"
                                    class="h-full w-full object-contain object-center transition group-hover:opacity-75"
                                    decoding="async" loading="lazy"
                                    sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 25vw"
                                    itemprop="image"
                                />
                            @else
                                <div class="flex h-full w-full items-center justify-center text-gray-400">
                                    Nema slike
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="mt-4 flex justify-between">
                        <div>
                            <h2 class="text-sm text-gray-700" itemprop="name">
                                <a href="{{ route('products.show', $p->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $p->title }}
                                </a>
                            </h2>

                        </div>

                        <p class="text-sm font-medium text-gray-900 px-1"
                           itemprop="offers"
                           itemscope
                           itemtype="https://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="EUR" />

                            <span itemprop="price" content="{{ number_format($p->price * 0.8, 2, '.', '') }}"
                                  class="font-semibold text-red-600">
                                    €{{ number_format($p->price * 0.8, 2) }}
                            </span>

                            <span class="text-gray-500 text-xs line-through ml-2">
        €{{ number_format($p->price, 2) }}
    </span>

                            <link itemprop="availability" href="https://schema.org/InStock" />
                        </p>
                    </div>
                </article>
            @empty
                <p class="text-gray-500">Trenutno nema dostupnih proizvoda.</p>
            @endforelse
        </div>
        {{-- {{ $products->links() }} --}}
    </div>
</x-app-layout>
