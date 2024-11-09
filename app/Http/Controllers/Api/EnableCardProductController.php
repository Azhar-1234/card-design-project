<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EnableCardProductController extends Controller
{
    public function show($id): JsonResponse
    {
        // Retrieve the product by ID and check if 'enable_card' is true
       $product = Product::where('id', $id)->first();

        // If product not found or 'enable_card' is false, return a 404 response
        // if (!$product) {
        //     return response()->json(['message' => 'Product not found or card feature is disabled'], Response::HTTP_NOT_FOUND);
        // }

        // Prepare the product data
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'price' => $product->price,
            'regular_price' => $product->regular_price,
            'sale_price' => $product->sale_price,
            'sku' => $product->sku,
            'stock_status' => $product->stock_status,
            'tags' => $product->tags, // Assuming tags relationship is loaded
            'image' => $product->image, // Assuming this holds images data
            'is_enabled' => $product->is_enabled,
            'url' => url("products/product/{$product->id}"),
        ];

        return response()->json($productData);
    }

}
