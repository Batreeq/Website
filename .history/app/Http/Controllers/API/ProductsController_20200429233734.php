<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use App\User;
use App\Order;
use App\UserLogs;
use App\UserStatistics;

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

        // update user logs
        $user = User::where('api_token', $request->get('api_token'))->first();
        $category = Category::find($request->get('category_id'));
        $user_logs = new UserLogs;
        $user_logs->user_id = $user->id;
        $user_logs->details = ' قام بالبحث عن منتجات الصنف ' . $category->name;
        $user_logs->c_p_id = $request->get('category_id');
        $user_logs->save();
        return response()->json([
            'products' => $products,
        ]);
    }

    // function to get all products based on offer id
    public function products(Request $request)
    {
        $offer_id = $request->get('offer_id');

        $products = Product::where('offers_ids', 'LIKE', "%$offer_id%")->limit(25)->get();
        if($request->get('api_token')){
            $user = User::where('api_token', $request->get('api_token'))->first();
            $user_statistics = UserStatistics::where('user_id', $user->id)->first();
            foreach ($products as $key => $product) {
                if($product->special_price){
                    
                }
            }
        }
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

    // function to get user's  carts
    public function getCarts(Request $request)
    {
		 $user = User::where('api_token', $request->get('api_token'))->first();
         $data = Cart::select('cart_num', 'cart_title')->where('user_id', $user->id)->where('status', '!=', 'delivered')->distinct('cart_title')->get();
         return response()->json([
             'carts' => $data,
         ]);
    }

    // function to get user's  cart info based on user id
    public function getUserCart(Request $request)
    {
		 $user = User::where('api_token', $request->get('api_token'))->first();
         $data = Cart::where('user_id', $user->id)->where('status', '!=', 'delivered')->get()->groupBy('cart_title')->toArray();
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

        if($request->get('cart_num') == '1'){
            $cart_title = 'السلة الرئيسية';
        } else {
            $old_cart = Cart::select('cart_title')->where('cart_num', $request->get('cart_num'))->first();
            if(isset($old_cart->cart_title) && strpos($old_cart->cart_title, 'مشاركة من') !== false){
                $cart_title =  $old_cart->cart_title;
            } else {
                $cart_title = 'سلة رقم ' .$request->get('cart_num');
            }
        }

        $cart->cart_num = $request->get('cart_num');
        $cart->cart_title = $cart_title;

        $cart->save();

        // update user logs
        $product = Product::find($request->get('product_id'));
        $user_logs = new UserLogs;
        $user_logs->user_id = $user->id;
        $user_logs->details = ' قام بإضافة المنتج  ' .$product->name. '  الى سلة الشراء  ';
        $user_logs->c_p_id = $request->get('product_id');
        $user_logs->save();

        return response()->json(['success'=>$cart]);
    }

    // function to add multiple products to user's cart
    public function addMultiToCart(Request $request)
    {
        $data = json_decode($request['data'])->data;
        $user = User::where('api_token', $request->get('api_token'))->first();
        foreach ($data as $key => $product) {
            $cart = new Cart;
            $cart->product_id = $product->product_id;
            $cart->user_id = $user->id;
            $cart->quantity = $product->quantity;
            $cart->price = $product->price;
            $cart->total_price = $product->total_price;
            $cart->status = 'pending';

            if($product->cart_num == '1'){
                $cart_title = 'السلة الرئيسية';
            } else {
                $old_cart = Cart::select('cart_title')->where('cart_num', $product->cart_num)->first();
                if(isset($old_cart->cart_title) && strpos($old_cart->cart_title, 'مشاركة من') !== false){
                    $cart_title =  $old_cart->cart_title;
                } else {
                    $cart_title = 'سلة رقم ' .$product->cart_num;
                }
            }

            $cart->cart_num = $product->cart_num;
            $cart->cart_title = $cart_title;

            // update user logs
            $product_name = Product::find($product->product_id);
            $user_logs = new UserLogs;
            $user_logs->user_id = $user->id;
            $user_logs->details = 'قام بإضافة المنتج  '.$product_name->name. ' الى  سلة الشراء ';
            $user_logs->c_p_id = $product->product_id;
            $user_logs->save();
            $cart->save();
        }
        return "success";
    }

    // function to share products to user's cart
    public function shareCart(Request $request)
    {
        $data = json_decode($request['data'])->data;
        $user = User::where('api_token', $request->get('api_token'))->first();
        $to_user = User::where('phone', $request->get('to_user'))->first();
        $cart_num = Cart::select('cart_num')->where('user_id', $to_user->id)->where('status', '!=', 'delivered')->orderBy('cart_num', 'DESC')->first();

        if(isset($cart_num)){
            $cart_num = $cart_num->cart_num;
        } else {
            $cart_num = '2';
        }
        if($user->name != null){
            $from_user = $user->name . ' مشاركة من ';
        } else {
            $from_user = $user->phone . ' مشاركة من ';
        }

        foreach ($data as $key => $product) {
            $cart = new Cart;
            $cart->product_id = $product->product_id;
            $cart->user_id = $to_user->id;
            $cart->quantity = $product->quantity;
            $cart->price = $product->price;
            $cart->total_price = $product->total_price;
            $cart->status = 'pending';

            $cart->cart_num = $cart_num;
            $cart->cart_title = $from_user;

            // update user logs
            $product_name = Product::find($product->product_id);
            $user_logs = new UserLogs;
            $user_logs->user_id = $user->id;
            $user_logs->details = 'قام بمشاركة سلة المشتريات مع ';
            $user_logs->c_p_id = $product->product_id;
            $user_logs->save();
            $cart->save();
        }
        return "success";
    }

    // function to remove products from user's cart
    public function deleteFromCart(Request $request)
    {
        $Cart = Cart::find($request->get('id'));
        $product = Product::find($Cart->product_id);

        // update user logs
        $user_logs = new UserLogs;
        $user_logs->user_id = $Cart->user_id;
        $user_logs->details = 'قام بحذف المنتج  '.$product->name. ' من سلة الشراء ';
        $user_logs->c_p_id = $Cart->product_id;
        $user_logs->save();

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

        // update user logs
        $Cart = Cart::find($request->get('id'));
        $user_logs = new UserLogs;
        $user_logs->user_id = $user->id;
        $user_logs->details = 'قام بتأكيد الطلب';
        $user_logs->c_p_id = $order->id;
        $user_logs->save();

        // update user statistics
        $user_statistics = UserStatistics::where('user_id', $user->id)->first();
        $user_statistics->purchase_count = (int) $user_statistics->purchase_count + 1;
        $user_statistics->purchase_amount = (int) $user_statistics->purchase_amount + (int) $request->get('total_price');
        $date = strtotime($user_statistics->start_date);
        $date2 = strtotime(date("Y-m-d"));
        $diff = $date2 - $date;
        $user_statistics->using_months = ceil($diff/60/60/24/30);
        $user_statistics->purchase_avg = $user_statistics->using_months == 0 ? $user_statistics->purchase_count / 1 : $user_statistics->purchase_count / $user_statistics->using_months;
        $user_statistics->purchase_months = $user_statistics->using_months == 0 ? $user_statistics->purchase_amount / 1  : $user_statistics->purchase_amount / $user_statistics->using_months;
        $user_statistics->save();

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
