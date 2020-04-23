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
		$offer_id = $request->get('offer_id');
        $products = Product::where('category_id', $request->get('category_id'))->where('offers_ids', 'LIKE', "%$offer_id%")->limit(25)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    // function to get all products based on offer id
    public function products(Request $request)
    {
        $offer_id = $request->get('offer_id');
        $products = Product::where('offers_ids', 'LIKE', "%$offer_id%")->limit(25)->get();
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

    // function to add multiple products to user's cart
    public function addMultiToCart(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        // foreach ($request->get('data') as $key => $product) {
        //     $cart = new Cart;
        //     $cart->product_id = $product->product_id;
        //     $cart->user_id = $user->id;
        //     $cart->quantity = $product->quantity;
        //     $cart->price = $product->price;
        //     $cart->total_price = $product->total_price;
        //     $cart->status = 'pending';
        //     $cart->save();
        // }
        return $request->get('data');
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

        $order = new Order;
        $order->user_name = $request->get('user_name');
        $order->user_id = $user->id;
        $order->phone = $request->get('phone');
        $order->city = $request->get('city');
        $order->region = $request->get('region');
        $order->location = $request->get('location');
        $order->notice = $request->get('notice');
        $order->delivery_type = $request->get('delivery_type');
        $order->payment_type = $request->get('payment_type');
        $order->total_price = $request->get('total_price');
        $order->delivery_time = $request->get('delivery_time');
        $order->order_details = json_encode($cartProducts);
        $order->status = 'not delivered';
        $order->save();

        // change the status for cart data from pending to confirmed
        $cartUpdate = Cart::where('user_id', $user->id)->update(['status' => 'confirmed']);

        return response()->json(['success'=>$order]);
    }

    // function to get users orders
    public function myOrders(Request $request)
    {
		 $user = User::where('api_token', $request->get('api_token'))->first();
         $orders = Order::where('user_id', $user->id)->get();
         $order_details = [];
         foreach ($orders as $key => $order) {
            $products_details = [];
            foreach (json_decode($order->order_details) as $key => $product) {
                $product_detail = Product::where('id', $product->product_id)->get();
                $catrgory = Category::where('id', $product_detail[0]->category_id)->get();
                array_push($products_details, array('quantity' => $product->quantity, 'price' => $product->price, 'total_price' => $product->total_price, 'product_details' => $product_detail[0], 'catrgory_name' => $catrgory[0]->name));
            }
			$date = explode("T", $order->created_at)[0];
			$order->created_date = explode(" ", $date)[0];
            $order->order_details = $products_details;
         }
         return response()->json([
             'orders' => $orders,
         ]);
    }

}
