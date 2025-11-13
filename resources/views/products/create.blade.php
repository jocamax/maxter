<x-app-layout>

<div class="container">
    <h1>Create product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" value="{{ old('title') }}" class="form-control" required>
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Price (RSD)</label>
            <input name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" class="form-control" required>
            @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Discount (%) — optional</label>
            <input name="discount" type="number" min="0" max="100"
                   value="{{ old('discount', 0) }}" class="form-control">
            <div class="form-text">0 = no discount. Example: 20 for 20% off.</div>
            @error('discount') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Technical data</label>
            <textarea name="technical_data" rows="4" class="form-control" required>{{ old('technical_data') }}</textarea>
            @error('technical_data') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Images (1–5)</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
            <div class="form-text">Hold CTRL / CMD to select multiple.</div>
            @error('images') <div class="text-danger small">{{ $message }}</div> @enderror
            @error('images.*') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Related products (0–5)</label>
            <select name="related[]" class="form-select" multiple size="6">
                @foreach($allProducts as $p)
                    <option value="{{ $p->id }}" @selected(collect(old('related',[]))->contains($p->id))>
                        {{ $p->title }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Use CTRL/CMD to choose up to 5.</div>
            @error('related') <div class="text-danger small">{{ $message }}</div> @enderror
            @error('related.*') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input name="category"
                   value="{{ old('category', $product->category ?? '') }}"
                   list="category-options"
                   class="form-control"
                   placeholder="e.g. Paint, Tools, Accessories">
            <datalist id="category-options">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}"></option>
                @endforeach
            </datalist>
            <div class="form-text">Type a new one or pick an existing.</div>
            @error('category') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
