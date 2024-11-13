<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function index(Request $request)
    {
        // Get the category by slug
        $category = Category::where('slug', $request->category)->firstOrFail();

        // Paginate the products within the selected category
        $products = $category->products()->where('is_visible', true)->paginate(10);

        // Format each product with the specific data you want to return
        $formattedProducts = $products->map(function ($product) {
            return [
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
                'images' => $product->getMedia('product-images')->map(function ($media) {
                    return $media->getUrl(); // Adjust to get specific image URLs
                }),
                'categories' => $product->categories->pluck('name'), // Include categories
            ];
        });

        return response()->json([
            'category' => $category,
            'products' => $formattedProducts,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }

}
