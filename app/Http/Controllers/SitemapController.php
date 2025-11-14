<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        $urls[] = URL::to('/');
        $urls[] = URL::to('/products');
        $urls[] = URL::to('/contact');
        $urls[] = URL::to('/about');

        foreach (Product::all() as $product) {
            $urls[] = route('products.show', $product->slug ?? $product->id);
        }

        return response()->view('sitemap', [
            'urls' => $urls
        ])->header('Content-Type', 'application/xml');
    }
}

