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
       $product = Product::where('id', $id)
                    ->where('is_card_enable', true)
                    ->with('categories') 
                    ->first();
        

        // If product not found or 'enable_card' is false, return a 404 response
        if (!$product) {
            return response()->json(['message' => 'Product not found or card feature is disabled'], Response::HTTP_NOT_FOUND);
        }
        $productImages = $product->getMedia('product-images')->map(function ($media) {
            return $media->getUrl();
        });
        // Prepare the product data
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'small_price' => $product->small_price,
            'medium_price' => $product->medium_price,
            'large_price' => $product->large_price,
            'small_price_discount' => $product->small_price_discount,
            'medium_price_discount' => $product->medium_price_discount,
            'large_price_discount' => $product->large_price_discount,
            'sku' => $product->sku,
            'is_card_enable' => $product->is_card_enable,
            'product_url' => url("products/product/{$product->id}"),
            'images' => $productImages, // Include product images
            'categories' => $product->categories->pluck('name'), // Include categories
        ];

        return response()->json($productData);
    }

}
