<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    // search in products functionality from home screen
    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', "%{$request->get('name')}%")->limit(10)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    // function to get products based on category id
    public function categorize(Request $request)
    {
        $products = Product::where('category_id', $request->get('category_id'))->limit(25)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    // function to get all products
    public function products(Request $request)
    {
        $products = Product::limit(2)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

}
