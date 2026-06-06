<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Static pages
        $staticPages = [
            ['loc' => route('homepage.home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('homepage.product'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('email.form'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = $page;
        }

        // Product detail pages
        $products = Product::select('id', 'nama', 'updated_at')->get();

        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('product.detail', $product->id),
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $product->updated_at->toW3cString(),
            ];
        }

        $sitemap = view('sitemap', compact('urls'))->render();

        return response($sitemap, 200, ['Content-Type' => 'application/xml']);
    }
}
