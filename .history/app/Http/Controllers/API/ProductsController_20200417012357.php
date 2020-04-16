<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use App\User;
use App\Order;

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
		 $user = User::where('api_token', $request->get('api_token'))->first();
         $data = Cart::where('user_id', $user->id)->where('status', 'pending')->get();
         return response()->json([
             'user_cart' => $data,
         ]);
    }

    // function to add products to user's cart
    public function addToCart(Request $request)
    {
		$user = User::where('api_token', $request->get('api_token'))->first();
        $cart = new Cart;
        $cart->product_id = $request->get('product_id');
        $cart->user_id = $user->id;
        $cart->quantity = $request->get('quantity');
        $cart->price = $request->get('price');
        $cart->total_price = $request->get('total_price');
        $cart->status = 'pending';
        $cart->save();
        return response()->json(['success'=>$cart]);
    }

    // function to remove products from user's cart
    public function deleteFromCart(Request $request)
    {
		$delete = Cart::where('id', $request->get('id'))->delete();
        return response()->json(['success'=>$delete]);
    }

    // function to confirm orders
    public function confirmOrder(Request $request)
    {
        // get user based on token
        $user = User::where('api_token', $request->get('api_token'))->first();

        // get order details from user cart
        $cartProducts = Cart::select('product_id','quantity', 'price', 'total_price')->where('user_id', $user->id)->where('status', 'pending')->get();

        // change the status for cart data from pending to confirmed
        $cartUpdate = Cart::where('user_id', $user->id)->update(['status' => 'confirmed']);

        $order = new Order;
        $order->user_name = $request->get('user_name');
        $order->user_id = $user->id;
        $order->quantity = $request->get('quantity');
        $order->price = $request->get('price');
        $order->total_price = $request->get('total_price');
        $order->status = 'pending';
        $order->save();

        return response()->json(['user'=>$user, 'orderDetails'=>json_encode($cartProducts)]);
    }

}
