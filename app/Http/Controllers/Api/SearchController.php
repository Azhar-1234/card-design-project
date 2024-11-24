<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\Customer; 
use App\Models\Shop\Product;       
use App\Models\Shop\Order;
use App\Models\Shop\OrderAddress;
use App\Models\Shop\Payment;
use App\Models\Shop\Brand; 
use App\Models\Shop\Category;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');

        // Search across multiple models and combine results
        $customers = Customer::search($query)->get();
        $products = Product::search($query)->get();
        $orders = Order::search($query)->get();
        $orderAddresses = OrderAddress::search($query)->get();
        $payments = Payment::search($query)->get();
        $brands = Brand::search($query)->get();
        $categories = Category::search($query)->get();
        

        return response()->json([
            'customers' => $customers,
            'products' => $products,
            'orders' => $orders,
            'orderAddresses' => $orderAddresses,
            'payments' => $payments,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }
}
