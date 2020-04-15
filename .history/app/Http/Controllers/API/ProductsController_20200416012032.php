<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;

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
        $products = Product::limit(25)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    // function to get all categories
    public function categories(Request $request)
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    // function to get user's  cart info based on user id
    public function getUserCart(Request $request)
    {
         $data = Cart::where('category_id', $request->get('category_id'))->limit(25)->get();
         return response()->json([
             'user_cart' => $data,
         ]);
    }

}
