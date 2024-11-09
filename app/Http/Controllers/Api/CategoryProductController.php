<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function index(Category $category)
    {
        $products = $category->products()->get();

        return response()->json($products);
    }
}
