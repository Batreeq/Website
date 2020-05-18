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
use App\DeliveryPrices;
use App\DeliveryLocations;
use DateTime;

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

        // paginate functionality
        // $products = Product::where('offers_ids', 'LIKE', "%$offer_id%")->paginate(2);

        if($request->get('api_token')){
            $user = User::where('api_token', $request->get('api_token'))->first();
            $user_statistics = UserStatistics::where('user_id', $user->id)->first();
            // $orders = Order::where('user_id', $user->id)->OrderBy('id', 'DESC')->get();
            $order_details = json_decode(Order::select('order_details')->where('user_id', $user->id)->get());
            $orderArr = array();
            foreach ($order_details as $key => $order) {
                foreach (json_decode($order->order_details) as $key2 => $details) {
                    if(isset(json_decode($order->order_details)[$key2 + 1])){
                        if($details->product_id != json_decode($order->order_details)[$key2 + 1]->product_id)
                        array_push($orderArr, $details->product_id);
                    }
                }
            }
            $cats = Product::select('category_id')->whereIn('id', $orderArr)->get();
            $cat_Arr = array();
            foreach ($cats as $key => $value) {
                array_push($cat_Arr, $value->category_id);
            }
            foreach ($products as $key => $product) {
                if($product->special_price){
                    switch ($product->special_price_for) {
                        case '1':
                            if($user_statistics->purchase_count < 3){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '2':
                            if($user_statistics->purchase_count > 3){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '3':
                            if($user_statistics->purchase_avg < 3){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '4':
                            if($user_statistics->purchase_avg > 3){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '5':
                            if($user_statistics->purchase_amount > 100){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '6':
                            if($user_statistics->purchase_amount < 100){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '7':
                            if($user_statistics->using_avg > 10){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '8':
                            if($user_statistics->using_avg < 10){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '9':
                            if($user_statistics->purchase_months > 30){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '10':
                            if($user_statistics->purchase_months < 30){
                                $product->price = $product->special_price;
                            }
                        break;
                        case '11':
                            if(in_array($product->category_id, $cat_Arr)){
                                $product->price = $product->special_price;
                            }
                        break;
                          case '12':

                        break;
                        case '13':

                        break;
                    }
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
        $cart_data = array_values($data);
        $data = array();
        foreach ($cart_data as $key => $cart) {
           foreach ($cart as $key2 => $cart2) {
                $start_datetime = new DateTime(date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($cart_data[$key][$key2]['created_at']))));
                $end_datetime = new DateTime(date('Y-m-d H:i:s'));
                if($cart_data[$key][$key2]['status'] == 'confirmed' && $start_datetime->diff($end_datetime)->y == 0 && $start_datetime->diff($end_datetime)->m == 0 && $start_datetime->diff($end_datetime)->d == 0 && $start_datetime->diff($end_datetime)->h > 4){
                    $cart_data[$key]->status = 'in progress';
                    $cart_data[$key]->save();
                } else {
                    $cart->product_details = Product::where('id', $cart2["product_id"])->first();
                    array_push($data, $cart);
                    // $cart_data[$key][$key2]['product_details'] = Product::where('id', $cart2["product_id"])->first();
                }
           }
        }
        return response()->json([
            'user_cart' => $data,
        ]);
    }

    // function to get delivery price based on location
    public function getDeliveryPrice(Request $request)
    {
         $prices = DeliveryPrices::where('location_id', $request->get('location_id'))->get();
         return response()->json([
             'times_prices' => $prices,
         ]);
    }

    // function to get cities
    public function getCities(Request $request)
    {
         $cities = array('Irbid' => "اربد", 'Zarqa' => 'الزرقاء', 'As-Salt' => "السلط", 'Aqaba' => 'العقبة', 'Kerak' => "الكرك", 'Al-Mafraq' => 'المفرق', 'Jerash' => 'الجرش', 'Ajloun' => "عجلون", 'Amman' => 'عمان', 'Madaba' => "مادبا", "Ma'an" => 'معان');
         return response()->json([
             'cities' => $cities,
         ]);
    }

    // function to get locations
    public function getLocations(Request $request)
    {
        $locations = DeliveryLocations::where('city', $request->get('city'))->get();
         return response()->json([
             'locations' => $locations,
         ]);
    }

    // function to add products to user's cart
    public function addToCart(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $oldCart = Cart::where('product_id', $request->get('product_id'))->where('user_id', $user->id)->where('cart_num', $request->get('cart_num'))->first();
        if($oldCart){
            $oldCart->quantity = (int) $oldCart->quantity + (int) $request->get('quantity');
            $oldCart->total_price = (int) $oldCart->total_price + (int) ($request->get('price') * $request->get('quantity'));
            $oldCart->save();
        } else {
            $cart = new Cart;
            $cart->product_id = $request->get('product_id');
            $cart->user_id = $user->id;
            $cart->quantity = $request->get('quantity');
            $cart->price = $request->get('price');
            $cart->total_price = $request->get('price') * $request->get('quantity');
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
		}

        // update user logs
        $product = Product::find($request->get('product_id'));
        $user_logs = new UserLogs;
        $user_logs->user_id = $user->id;
        $user_logs->details = ' قام بإضافة المنتج  ' .$product->name. '  الى سلة الشراء  ';
        $user_logs->c_p_id = $request->get('product_id');
        $user_logs->save();

        return 'success';
    }

    // function to add multiple products to user's cart
    public function addMultiToCart(Request $request)
    {
        $data = json_decode($request['data'])->data;
        $user = User::where('api_token', $request->get('api_token'))->first();
        foreach ($data as $key => $product) {
            $oldCart = Cart::where('product_id', $request->get('product_id'))->where('user_id', $user->id)->first();
            if($oldCart){
                $oldCart->quantity = (int) $oldCart->quantity + (int) $product->quantity;
                $oldCart->total_price = (int) $oldCart->total_price + (int) ($product->price * $product->quantity);
                $oldCart->save();
            } else {
                $cart = new Cart;
                $cart->product_id = $product->product_id;
                $cart->user_id = $user->id;
                $cart->quantity = $product->quantity;
                $cart->price = $product->price;
                $cart->total_price = $product->price * $product->quantity;
                $cart->status = 'pending';
            }

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
        $user = User::where('api_token', $request->get('api_token'))->first();
		$data = Cart::where('user_id', $user->id)->where('cart_num', $request->get('cart_num'))->get();
        $to_user = User::where('phone', $request->get('to_user'))->first();
        $cart_num = Cart::select('cart_num')->where('user_id', $to_user->id)->where('status', '!=', 'delivered')->where('shared_by', $user->id)->orderBy('cart_num', 'DESC')->first();

        if(isset($cart_num)){
            $cart_num = $cart_num->cart_num;
        } else {
			$last_cart_num = Cart::select('cart_num')->where('user_id', $to_user->id)->where('status', '!=', 'delivered')->orderBy('cart_num', 'DESC')->first();
			if($last_cart_num){
				$cart_num = (int) $last_cart_num->cart_num + 1;
			} else {
				$cart_num = '2';
			}

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
			$cart->shared_by = $user->id;
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

		$orders = Order::where('user_id', $user->id)->where('status', 'not delivered')->get();
		if($orders){
			$oldOrders = array();
			foreach($orders as $order){
				foreach(json_decode($order->order_details) as $detail){
					if(isset($detail->cart_num)){
						if($request->get('cart_num') == $detail->cart_num){
							$order->delete();
						}
					}
				}
			}
		}



        // get order details from user cart
        $cartProducts = Cart::select('product_id','quantity', 'cart_num', 'price', 'total_price')->where('user_id', $user->id)->where('cart_num', $request->get('cart_num'))->get();

        $total_price = 0;
        $total_points = $user->points ? (int) $user->points : 0;
		foreach($cartProducts as $product){
            $total_price += $product->price * $product->quantity;
            $product = Product::find($product->product_id);
            $total_points = $product->points ? $total_points + (int) $product->points : $total_points;
        }

        $user->points = $total_points;
        $user->save();

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
        $order->total_price = $total_price;
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

    // function to update item quentity in cart
    public function updateItem(Request $request) {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $cart = Cart::where('id',$request->get('cart_id'))->first();
        $cart->quantity = $request->get('quantity');
        $cart->total_price = $cart->price * $request->get('quantity');
        $cart->save();
        // $oldOrders = array();
		// foreach($orders as $order){
		// 	foreach(json_decode($order->order_details) as $detail){
		// 		if($request->get('cart_num') == $detail->cart_num && $request->get('product_id') == $detail->product_id){
        //             $detail->quantity = $request->get('quantity');
        //             $detail->total_price = $detail->price * $request->get('quantity');
        //         }
        //         array_push($oldOrders, $detail);
        //     }
        //     $order->order_details = json_encode($oldOrders);
        //     $order->save();
        // }
        return response()->json(['success'=> $cart]);
    }

    // function to get users orders
    public function myOrders(Request $request)
    {
		 $user = User::where('api_token', $request->get('api_token'))->first();
         $orders = Order::where('user_id', $user->id)->get();
         $order_details = [];
         $categories_count = 0;
         $categories_stat = [];
         $products_stat = [];
         foreach ($orders as $key => $order) {
            $products_details = [];
            foreach (json_decode($order->order_details) as $key => $product) {
                $categories_count++;
                $product_detail = Product::where('id', $product->product_id)->get();
                $catrgory = Category::where('id', $product_detail[0]->category_id)->get();
                array_push($products_details, array('quantity' => $product->quantity, 'price' => $product->price, 'total_price' => $product->total_price, 'product_details' => $product_detail[0], 'catrgory_name' => $catrgory[0]->name));
                array_push($categories_stat, array('quantity' => $product->quantity, 'total_price' => $product->total_price, 'catrgory_name' => $catrgory[0]->name, 'date' => explode("T", explode(" ", $order->created_at)[0])[0]));
                array_push($products_stat, array('quantity' => $product->quantity, 'total_price' => $product->total_price, 'product_name' => $product_detail[0]->name, 'date' => explode("T", explode(" ", $order->created_at)[0])[0]));
            }
            $date = explode("T", $order->created_at)[0];
            $order->created_date = explode(" ", $date)[0];
            $order->created_time = substr(explode(" ", $date)[1],0, 5);
            $order->order_details = $products_details;
            $order->categories_count = $categories_count;
//            $order->categories_statistics = $categories_stat;
//           $order->products_statistics = $products_stat;
         }
         return response()->json([
             'orders' => $orders,
			 'categories_statistics' => $categories_stat,
			 'products_statistics' => $products_stat,
         ]);
    }

}
