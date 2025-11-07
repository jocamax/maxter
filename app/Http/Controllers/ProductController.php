<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dir = $request->input('price_sort');
        $dir = in_array($dir, ['asc', 'desc']) ? $dir : 'asc';


        $query = Product::with(['images' => fn($q) => $q->limit(1)])->orderBy('price', $dir);

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $products = $query->paginate(25)->withQueryString();
        $categories = $this->categoryOptions();

        return view('products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryOptions();
        $allProducts = Product::orderBy('title')->get(['id','title']);
        return view('products.create', compact('allProducts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        DB::transaction(function () use ($request) {
            $product = Product::create($request->only('title','price','description','technical_data', 'category'));

            foreach ($request->file('images', []) as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'sort_order' => $i,
                ]);
            }

            $relatedIds = collect($request->input('related', []))
                ->filter(fn($id) => (int)$id !== (int)$product->id)
                ->take(5)
                ->all();
            $product->related()->sync($relatedIds);
        });
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                if (!$file->isValid()) dd([$i, $file->getError(), $file->getErrorMessage()]);
            }
        }
        return redirect()->route('products.index')
        ->with('ok', 'Product created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'images' => fn($q) => $q->orderBy('sort_order'),
            'related.images' => fn($q) => $q->limit(1),
        ]);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product) {
        $categories = $this->categoryOptions();

        $product->load('images','related:id');
        $allProducts = Product::orderBy('title')->get(['id','title']);
        return view('products.edit', compact('product','allProducts','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product) {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->only('title','price','description','technical_data', 'category'));

            $currentCount = $product->images()->count();
            $incoming = count($request->file('images', []));
            if ($currentCount + $incoming > 5) {
                abort(422, 'Total images cannot exceed 5.');
            }
            foreach ($request->file('images', []) as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'sort_order' => $currentCount + $i,
                ]);
            }

            $relatedIds = collect($request->input('related', []))
                ->filter(fn($id) => (int)$id !== (int)$product->id)
                ->take(5)
                ->all();
            $product->related()->sync($relatedIds);
        });

        return redirect()->route('products.show', $product)->with('ok','Product updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $user = auth()->user();

        if($user){
            $product->load('images');
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->path);
            }
            $product->delete();
        }
        return redirect()->route('products.index')->with('ok','Product deleted.');
    }

    private function categoryOptions()
    {
        return Product::query()
            ->whereNotNull('category')
            ->where('category','!=','')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    }

    public function reorderImages(Request $request, Product $product)
    {
        $data = $request->validate([
            'order'   => ['required','array','min:1'],
            'order.*' => ['integer','exists:product_images,id'],
        ]);

        $incoming = collect($data['order'])->map(fn($id) => (int) $id)->values();
        $current  = $product->images()->pluck('id')->map(fn($id) => (int) $id)->values();

        if ($incoming->count() !== $current->count()
            || $incoming->diff($current)->isNotEmpty()
            || $current->diff($incoming)->isNotEmpty()) {
            abort(422, 'Order must include exactly this product’s images.');
        }

        DB::transaction(function () use ($incoming, $product) {
            foreach ($incoming as $index => $imageId) {
                \App\Models\ProductImage::where('product_id', $product->id)
                    ->whereKey($imageId)
                    ->update(['sort_order' => $index]);
            }
        });

        return response()->noContent();
    }

    public function getMasineZaFarb(Request $request, Product $product){
        $query = Product::with(['images' => fn($q) => $q->limit(1)])->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        } else{
            $query->where('category','airless');
        }

        $products = $query->paginate(25)->withQueryString();
        $categories = $this->categoryOptions();

        return view('products.airlesscategory', compact('products','categories'));
    }

    public function getMasineZaPesk(Request $request, Product $product){
        $query = Product::with(['images' => fn($q) => $q->limit(1)])->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        } else{
            $query->where('category','Masine-za-peskarenje');
        }

        $products = $query->paginate(25)->withQueryString();
        $categories = $this->categoryOptions();

        return view('products.peskarenjecategory', compact('products','categories'));
    }
}
