<x-app-layout>
    <div class="bg-white p-5">
        <div class="mx-auto max-w-2xl px-4 py-12 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Mašine za farbanje</h1>
                <form method="GET" class="flex items-center gap-2">
                    <select
                        name="category"
                        class="w-56 rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500"
                    >
                        <option value="">airless</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>

                    <button class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                        Potvrdi
                    </button>

                    @if(request('category'))
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Obriši</a>
                    @endif
                </form>

                @auth
                    <a href="{{ route('products.create') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        New Product →
                    </a>
                @endauth
            </div>

        </div>

        <div class="mt-6 grid grid-cols-1 max-w-7xl m-auto gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse ($products as $p)
                <div class="group relative">
                    <a href="{{ route('products.show', $p->id) }}" class="block">
                        <div class="aspect-square w-full overflow-hidden rounded-md bg-white shadow-md">
                            @php $img = $p->images->first(); @endphp
                            @if($img)
                                <img
                                    src="{{ asset('storage/'.$img->path) }}"
                                    alt="{{ $p->title }}"
                                    class="h-full w-full object-contain object-center transition group-hover:opacity-75"
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
                            <h3 class="text-sm text-gray-700">
                                <a href="{{ route('products.show', $p->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $p->title }}
                                </a>
                            </h3>
                            {{-- Optional short meta under title --}}
                            {{-- <p class="mt-1 text-sm text-gray-500 line-clamp-1">{{ \Illuminate\Support\Str::limit($p->description, 40) }}</p> --}}
                        </div>
                        <p class="text-sm font-medium text-gray-900 px-1">
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
                </div>
            @empty
                <p class="text-gray-500">Trenutno nema dostupnih proizvoda.</p>
            @endforelse
        </div>

    </div>
    </div>
</x-app-layout>
