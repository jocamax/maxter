{{-- ====== SEO PER-PRODUCT ====== --}}
@php
    $mainImg = optional($product->images->first())->path ? asset('storage/'.$product->images->first()->path) : asset('images/og-default.jpg');
    $descForMeta = \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 155);
    $canonicalUrl = route('products.show', $product->id);
@endphp

@section('title', $product->title . ' — Maxter')
@section('meta_description', $descForMeta)
@section('canonical', $canonicalUrl)

@section('og_type', 'product')
@section('og_title', $product->title . ' — Maxter')
@section('og_description', $descForMeta)
@section('og_url', $canonicalUrl)
@section('og_image', $mainImg)
@section('og_image_alt', $product->title . ' — fotografija proizvoda')

@section('twitter_title', $product->title . ' — Maxter')
@section('twitter_description', $descForMeta)
@section('twitter_image', $mainImg)

{{-- JSON-LD: Product + BreadcrumbList --}}
@section('jsonld')
    <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'Product',
          'name' => $product->title,
          'image' => $product->images->map(fn($i) => asset('storage/'.$i->path))->values()->all() ?: [$mainImg],
          'description' => \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 300),
          'sku' => $product->sku ?? (string)$product->id,
          'category' => $product->category ?? null,
          'brand' => ['@type' => 'Brand', 'name' => 'Maxter'],
          'offers' => [
              '@type' => 'Offer',
              'url' => $canonicalUrl,
              'priceCurrency' => 'EUR',
              'price' => number_format($product->price ?? 0, 2, '.', ''),
              'availability' => ($product->in_stock ?? true) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
              'itemCondition' => 'https://schema.org/NewCondition'
          ]
        ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => array_values(array_filter([
              [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Početna',
                'item' => route('home')
              ],
              [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Proizvodi',
                'item' => route('products.index')
              ],
              !empty($product->category) ? [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $product->category,
                'item' => route('products.index', ['category' => $product->category])
              ] : null,
              [
                '@type' => 'ListItem',
                'position' => empty($product->category) ? 3 : 4,
                'name' => $product->title,
                'item' => $canonicalUrl
              ]
          ]))
        ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
    </script>
@endsection


<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-12 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-700">Početna</a></li><span aria-hidden="true">/</span>
                    <li><a href="{{ route('products.index') }}" class="hover:text-gray-700">Proizvodi</a></li>
                    @if(!empty($product->category))
                        <span aria-hidden="true">/</span>
                        <li><a href="{{ route('products.index', ['category'=>$product->category]) }}" class="hover:text-gray-700">{{ $product->category }}</a></li>
                    @endif
                    <span aria-hidden="true">/</span>
                    <li aria-current="page" class="text-gray-700">{{ $product->title }}</li>
                </ol>
            </nav>

            <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
                {{-- Galerija --}}
                <div class="flex flex-col-reverse">
                    @if($product->images->count())
                        <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                            <div class="grid grid-cols-4 gap-6" role="list" aria-label="Galerija sličica">
                                @foreach($product->images as $idx => $img)
                                    @php $thumbUrl = asset('storage/'.$img->path); @endphp
                                    <button
                                        type="button"
                                        class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium text-gray-900 uppercase hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2"
                                        data-image-src="{{ $thumbUrl }}"
                                        aria-label="Prikaži sliku {{ $idx+1 }}"
                                    >
                    <span class="absolute inset-0 overflow-hidden rounded-md">
                      <img
                          src="{{ $thumbUrl }}"
                          alt="{{ $product->title }} — sličica {{ $idx+1 }}"
                          class="w-full h-full object-cover"
                          decoding="async" loading="lazy"
                          sizes="(max-width: 640px) 25vw, (max-width: 1024px) 15vw, 6rem"
                      />
                    </span>
                                        <span aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-transparent ring-offset-2"></span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        @php $main = $product->images->first(); @endphp
                        <img
                            id="mainProductImage"
                            src="{{ $main ? asset('storage/'.$main->path) : '' }}"
                            alt="{{ $product->title }} — glavna fotografija proizvoda"
                            class="aspect-square w-full object-contain sm:rounded-lg"
                            decoding="async" fetchpriority="high"
                            sizes="(max-width: 1024px) 100vw, 50vw"
                        />
                    </div>
                </div>

                <div class="mt-10 px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->title }}</h1>
                    @if(!empty($product->category))
                        <p class="mt-1 text-sm text-gray-600">{{ $product->category }}</p>
                    @endif

                    @auth
                        <div class="flex gap-2 mt-4">
                            <a href="/products/{{ $product->id }}/edit" class="p-2 bg-red-600 rounded-md text-white">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-950 text-white p-2 rounded-md">Delete</button>
                            </form>
                        </div>
                    @endauth

                    <div class="mt-3">
                        <h2 class="sr-only">Informacije o proizvodu</h2>
                        <p class="text-3xl tracking-tight text-gray-900" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="EUR" />


                            <span itemprop="price" content="{{ number_format($product->price * 0.8, 2, '.', '') }}"
                                  class="font-semibold text-red-600">
                                €{{ number_format($product->price * 0.8, 2) }}
                            </span>

                            <span class="text-gray-500 line-through text-lg ml-3">
                                €{{ number_format($product->price, 2) }}
                            </span>

                            <span class="text-base text-gray-500 ml-2">+ PDV</span>
                        </p>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-base font-semibold text-gray-900">Opis proizvoda</h3>
                        <div class="mt-2 space-y-4 text-base text-gray-700">
                            <p class="whitespace-pre-line leading-5">{{ $product->description }}</p>
                        </div>
                    </div>

                    <section aria-labelledby="details-heading" class="mt-10">
                        <h2 id="details-heading" class="text-base font-semibold text-gray-900">Specifikacije</h2>
                        <div class="mt-2 border-t border-gray-200 divide-y divide-gray-200">
                            <div class="py-6">
                                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                                    {{ $product->technical_data }}
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="mt-4 flex gap-4">
                        <a href="/contact" class="flex items-center justify-center rounded-md bg-red-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" aria-label="Pošalji upit za {{ $product->title }}">
                            Upit
                        </a>

                        <button type="button" class="rounded-md px-3 py-3 text-gray-400 hover:bg-gray-100 hover:text-gray-600" title="Dodaj u omiljene" aria-pressed="false">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="h-6 w-6">
                                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="sr-only">Dodaj u omiljene</span>
                        </button>
                    </div>
                </div>
            </div>

            @if($product->related->isNotEmpty())
                <div class="mt-16">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Povezani proizvodi</h2>
                    <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8" role="list" aria-label="Povezani proizvodi">
                        @foreach($product->related as $rel)
                            <a href="{{ route('products.show', $rel->id) }}" class="group block" aria-label="Pogledaj: {{ $rel->title }}" role="listitem">
                                <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100">
                                    @php $relImg = $rel->images->first(); @endphp
                                    @if($relImg)
                                        <img
                                            src="{{ asset('storage/'.$relImg->path) }}"
                                            alt="{{ $rel->title }} — fotografija proizvoda"
                                            class="h-full w-full object-cover object-center group-hover:opacity-90"
                                            decoding="async" loading="lazy"
                                            sizes="(max-width: 640px) 50vw, (max-width: 1024px) 33vw, 25vw"
                                        >
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-gray-400">No image</div>
                                    @endif
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <h3 class="text-sm text-gray-900">{{ $rel->title }}</h3>
                                    <div class="text-sm text-gray-900">
                                        <span class="font-semibold text-red-600">
                                            €{{ number_format($rel->price * 0.8, 2) }}
                                        </span>
                                        <span class="text-gray-500 line-through ml-2">
                                         €{{ number_format($rel->price, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const main = document.getElementById('mainProductImage');
            if (!main) return;
            document.querySelectorAll('[data-image-src]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const src = btn.getAttribute('data-image-src');
                    if (src) {
                        main.setAttribute('src', src);
                        // promena alt-a da ostane smislen
                        const idx = [...btn.parentNode.children].indexOf(btn) + 1;
                        main.setAttribute('alt', @json($product->title) + ' — fotografija ' + idx);
                    }
                });
            });
        });
    </script>
</x-app-layout>
