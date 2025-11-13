<x-app-layout>
    <div class="flex flex-col items-center w-full">
        <h1>Edit product</h1>

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT')

            <div class="mb-3 m-auto">
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title', $product->title) }}" class="form-control" required>
                @error('title') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Price (RSD)</label>
                <input name="price" type="number" step="0.01" min="0" value="{{ old('price', $product->price) }}" class="form-control" required>
                @error('price') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Discount (%) — optional</label>
                <input name="discount"
                       type="number"
                       min="0"
                       max="100"
                       value="{{ old('discount', $product->discount ?? 0) }}"
                       class="form-control">

                <div class="form-text">0 = no discount. Example: 20 for 20% off.</div>

                @error('discount')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control w-96" required>{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Technical data</label>
                <textarea name="technical_data" rows="4" class="form-control" required>{{ old('technical_data', $product->technical_data) }}</textarea>
                @error('technical_data') <div class="text-red-600 ">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input name="category"
                       value="{{ old('category', $product->category ?? '') }}"
                       list="category-options"
                       class="form-control"
                       placeholder="Kategorija">
                <datalist id="category-options">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}"></option>
                    @endforeach
                </datalist>
                <div class="form-text">Type a new one or pick an existing.</div>
                @error('category') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label mb-2">Images (drag to reorder)</label>

                <ul id="imageList" class="list-unstyled">
                    @foreach($product->images as $img)
                        <li class="d-flex align-items-center gap-3 border rounded p-2 mb-2 bg-white" data-id="{{ $img->id }}">
                            <span class="handle text-muted px-2" style="cursor:grab" title="Drag">≡</span>
                            <img src="{{ asset('storage/'.$img->path) }}" class="rounded" style="width:64px;height:64px;object-fit:cover" alt="">
                            <small class="text-muted text-truncate">{{ $img->path }}</small>

{{--                            <form class="ms-auto" method="POST" action="{{ route('products.images.destroy', [$product, $img]) }}"--}}
{{--                                  onsubmit="return confirm('Remove this image?')">--}}
{{--                                @csrf @method('DELETE')--}}
{{--                                <button class="btn btn-sm btn-outline-danger">Remove</button>--}}
{{--                            </form>--}}
                        </li>
                    @endforeach
                </ul>

                <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const el = document.getElementById('imageList');
                        if (!el) return;

                        const saveOrder = () => {
                            const order = Array.from(el.querySelectorAll('[data-id]'))
                                .map(li => Number(li.dataset.id));
                            fetch('{{ route('products.images.reorder', $product) }}', {
                                method: 'PATCH',
                                credentials: 'same-origin', // <-- add this
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({ order }),
                            })
                                .then(res => {
                                    if (!res.ok) {
                                        return res.text().then(t => { throw new Error(`Reorder failed (${res.status}): ${t}`); });
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    alert('Failed to save image order. Are you logged in?');
                                });
                        };

                        new Sortable(el, {
                            handle: '.handle',
                            animation: 150,
                            onEnd: saveOrder,
                        });
                    });
                </script>

                <div class="">
                    Drag rows by the ≡ handle to change order. The first item becomes the main image.
                </div>
            </div>

            {{-- Add more images --}}
            <div class="mb-3">
                <label class="form-label">Add images (optional)</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <div class="form-text">You can add more (max total 5). Hold CTRL/CMD to select multiple.</div>
                @error('images') <div class="text-red-600">{{ $message }}</div> @enderror
                @error('images.*') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            {{-- Related products --}}
            <div class="mb-3">
                <label class="form-label">Related products (0–5)</label>
                @php
                    $selectedRelated = collect(old('related', $product->related->pluck('id')->all()));
                @endphp
                <select name="related[]" class="form-select" multiple size="6">
                    @foreach($allProducts as $p)
                        <option value="{{ $p->id }}" @selected($selectedRelated->contains($p->id))>
                            {{ $p->title }}
                        </option>
                    @endforeach
                </select>
                <div class="form-text">Use CTRL/CMD to choose up to 5.</div>
                @error('related') <div class="text-red-600">{{ $message }}</div> @enderror
                @error('related.*') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
