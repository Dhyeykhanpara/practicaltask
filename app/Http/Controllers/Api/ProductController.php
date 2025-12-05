<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // gather only the expected filter inputs
        $filters = $request->only(['search', 'category', 'min_price', 'max_price']);

        $perPage = (int) $request->query('per_page', 10);

        $products = Product::query()
            ->filter($filters)                 // uses the scopeFilter
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return response()->json($products);
    }

    // POST /api/products
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        return response()->json($product, 201);
    }
}
