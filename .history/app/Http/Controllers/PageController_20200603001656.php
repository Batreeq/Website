<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homeblocks;
use App\Product;
use App\Order;
use App\DeliveryLocations;
use App\DeliveryPrices;
use App\PointsProducts;
use App\Points;
use App\Drivers;
use App\Copouns;
use App\Rounds;
use App\Category;
use App\Posts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageController extends Controller
{

    /**
     * Display products page
     *
     * @return \Illuminate\View\View
     */
    public function products_categories()
    {
        return view('pages.product-category');
    }


    public function driver()
    {
        $PendingDrivers=Drivers::where('status','=','pending')->get();
        $Drivers=Drivers::where('status','=','approved')->get();
        return view('pages.drivers',['PendingDrivers'=> $PendingDrivers , 'Drivers'=>$Drivers ]);
    }

    public function add_driver()
    {
        $driver=null;
        if(isset($_GET['id'])){
         $driver= Drivers::where('id','=',$_GET['id'])->get();
         return view('pages.driver-add',['driver'=>$driver[0]]);
        }else{
            return view('pages.driver-add');
        }

    }

    public function add_driver_action(Request $request)
    {
        $Drivers = new Drivers;
        $Drivers->name = $request->name;
        $Drivers->driver_token = hash('sha256', Str::random(60));
        $Drivers->password=Hash::make($request->password);
        $Drivers->phone =  $request->phone;
        $Drivers->second_phone =  $request->phone2;
        $Drivers->location =  $request->location;
        $Drivers->car = $request->car;
        $Drivers->car_model = $request->model;
        $Drivers->status = 'pending';
        $Drivers->created_at= date("Y-m-d h:i:s");
        $Drivers->updated_at= date("Y-m-d h:i:s");
        $Drivers->lang=  $request->lang;
        $Drivers->save();
        return back()->with('success','تم إضافة سائق جديد بنجاح');
    }

    public function edit_driver_action(Request $request){
        Drivers::where('id', '=', $request->driver_id)->update([
        'name'=> $request->name,
        'password'=> Hash::make($request->password),
        'phone' =>$request->phone,
        'second_phone'=>  $request->phone2,
        'location'=>  $request->location,
        'car'=> $request->car,
        'car_model' =>$request->model,
        'updated_at' => date("Y-m-d h:i:s")
        ]);
        return back()->with('success','تم تعديل معلومات السائق بنجاح');

    }

    public function approved_driver($user)
    {
        Drivers::where('id', '=', $user)->update(['status' => 'approved','updated_at' => date("Y-m-d h:i:s")]);
        return back()->with('success','تم قبول سائق جديد');
    }

    public function declined_driver()
    {

      if(isset($_GET['id'])){
        Drivers::where('id', '=', $_GET['id'])->update(['status' => 'declined','updated_at' => date("Y-m-d h:i:s")]);
       }
        return "success!";
    }

    public function remove_driver(){
        if(isset($_GET['id'])){
        Drivers::where('id', '=', $_GET['id'])->delete();
        }
        return "success!";

    }

    public function calculate_points(){
        $Points= Points::all();
        $Products=Product::whereNull('points')->get();
        $ProductsWithPoint=Product::where('points',"!=","null")->get();
        return view('pages.calculate-points',['Points'=> $Points, 'ProductsWithPoint'=>$ProductsWithPoint,'Products'=> $Products]);
    }

    public function update_calculate_point(Request $request){
        Product::where('id', $request->product_id)->update(['points' => $request->new_points,'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم التعديل على نقاط هذا المنتج بنجاح');
    }

    public function actions_point(Request $request){
        Points::where('id', $request->action_id)->update(['points' => $request->points,'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم التعديل على نقاط هذا الحدث بنجاح');
    }

    public function add_calculate_point (Request $request){
        Product::where('id', $request->add_product_id)->update(['points' => $request->product_point]);
        return back()
        ->with('success','تمت إضافة نقاط لهذا المنتج بنجاح');
    }


    public function replace_points(){
        $PointsProducts = PointsProducts::all();
        return view('pages.replace-products',['PointsProducts'=>$PointsProducts]);
    }

    public function replace_product_point(Request $request){
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(isset(request()->image)){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $Image= "https://".$_SERVER['HTTP_HOST'].'/images/'.$imageName;
        }
        $PointsProducts = new PointsProducts;
        $PointsProducts->product_name = $request->name;
        $PointsProducts->product_image =  $Image;
        $PointsProducts->points = $request->point;
        $PointsProducts->lang = $request->lang;
        $PointsProducts->save();
        return back()->with('success','تمت إضافة المنتج المستخدم في استبدال النقاط بنجاح');

    }


    public function remove_replace_product_point(){
        if(isset($_GET['id'])){
          PointsProducts::where('id', '=', $_GET['id'])->delete();
        }
        return "success!";
    }
    public function edit_replace_product_point(Request $request){
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(isset(request()->image)){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $Image= "https://".$_SERVER['HTTP_HOST'].'/images/'.$imageName;
        }

         PointsProducts::where('id', $request->product_id)->update([
            'product_name' => $request->name,
            'product_image' =>  $Image,
            'points' => $request->point,
            'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم التعديل على نقاط هذا المنتج بنجاح');
    }
    /**
     * Display Work us page
     *
     * @return \Illuminate\View\View
     */
    public function work_us()
    {
        return view('pages.work-us');
    }
     public function work_us_screen()
    {
        return view('pages.work-us-screens');
    }

    /**
     * Display different parts page
     *
     * @return \Illuminate\View\View
     */
    public function different_parts()
    {
        $parts = Homeblocks::all();
        return view('pages.different-parts', compact('parts'));
    }

    public function profile_fields()
    {

        return view('pages.profile-fields');
    }

    public function home_different_parts(){
         return view('pages.home-differents-parts');
    }

    public function posts(){
        $posts = Posts::all();
        $products = Product::all();
        return view('pages.posts', compact('products','posts'));
    }

    public function add_post(Request $request){
        $product = Product::find($request->product_id);
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(isset(request()->image)){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $Image= "https://".$_SERVER['HTTP_HOST'].'/images/'.$imageName;
        }
        $post = new Posts();
        $post->image = $Image;
        $post->product_id = $request->product_id;
        $post->product_name = $product->name;
        $post->save();

        return back()
        ->with('success','تمت إضافة الإعلان بنجاح');
    }

    public function edit_different_parts(Request $request)
    {
        $offer = Homeblocks::find($request->offer);
        return view('pages.edit-different-parts', compact('offer'));
    }

    /**
     * Display users page
     *
     * @return \Illuminate\View\View
     */
    // public function users()
    // {
    //     return view('pages.users');
    // }

    /**
     * Display delivery page
     *
     * @return \Illuminate\View\View
     */
    public function delivery()
    {
        return view('pages.delivery');
    }

    public function round()
    {
        $delivery_prices= DeliveryPrices::select()->distinct()->get();
        $result=[];
        $index = 0;
        $rounds=Rounds::all();
        foreach($delivery_prices as $value) {
            $result[$index++]=$value->location_id;
            foreach($rounds as $item) {
                if($value->id == $item->delivery_prices_id){
                    $item->time=$value->time;
                    $deliveryLocat= DeliveryLocations::where('id','=',$value->location_id)->get();
                    $item->location_name=$deliveryLocat[0]->location;
                }
            }
        }
        $deliveryLocations= DeliveryLocations::whereIn('id',$result)->get();
        return view('pages.round',['deliveryLocations'=>$deliveryLocations,'rounds'=>$rounds]);
    }

    public function fetch_timing_round(Request $request){
         $price=DeliveryPrices::select('time','id')->where([
                ['location_id',$request->location],

            ])->get();

        return  response()->json(['data' => $price]);
    }

    public function fetch_rounds(Request $request){

        $result1=Rounds::select('id','type','value')->where('value','=',$request->time)->get();
        $result2=Rounds::select('id','type','value')->whereIn('type',["السعر","الكمية"])->get();

        return  response()->json(['data' =>[$result1, $result2] ]);
    }

    public function link_round_request(Request $request){
        echo $request->rounds_id;
        echo $request->timing;

        DeliveryPrices::where('id', $request->timing)->update(['round_id' => $request->rounds_id,'updated_at' => date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تم ربط طلبية جديدة مع أحد الجولات بشكل ناجح');
    }


    public function add_round(Request $request)
    {


        $result=Rounds::where('delivery_prices_id', $request->timing)->get();
         echo count($result);
        $rounds= new Rounds;
        $rounds->type= $request->round_type;
        if($request->round_type=="الوقت"){
            $rounds->value= $request->round_timing;
        }else{
            $rounds->value= $request->round_value;
        }
        $rounds->delivery_prices_id= $request->timing;
        $rounds->round_num= count($result)+1;
        $rounds->lang= $request->lang;

        $rounds->save();
         return back()->with('success','تم إضافة جولة جديدة بشكل ناجح');
        // if($request->timing == 'all-times'){
        //     // times array
        //     $times = array('8-10 ص' , '10-12 ص', '12-2 م', '2-4 م', '4-6 م');

        //     DeliveryPrices::where([
        //         ['round_capacity',$request->capacity ],
        //         ['orders_num',$request->num_orders],

        //     ])->delete();

        //     foreach($times as $value){
        //         $deliveryPrices = new DeliveryPrices;
        //         $deliveryPrices->round_capacity= $request->capacity;
        //         $deliveryPrices->time = $value;
        //         $deliveryPrices->orders_num= $request->num_orders;
        //         $deliveryPrices->type= "round_system";
        //         $deliveryPrices->price = $request->price;
        //         $deliveryPrices->created_at= date("Y-m-d h:i:s");
        //         $deliveryPrices->updated_at= date("Y-m-d h:i:s");
        //         $deliveryPrices->save();
        //     }
        // } else {
        //     $deliveryPrices = new DeliveryPrices;
        //     $deliveryPrices->round_capacity= $request->capacity;
        //     $deliveryPrices->time = $request->timing;
        //     $deliveryPrices->orders_num= $request->num_orders;
        //     $deliveryPrices->type= "round_system";
        //     $deliveryPrices->price = $request->price;
        //     $deliveryPrices->created_at= date("Y-m-d h:i:s");
        //     $deliveryPrices->updated_at= date("Y-m-d h:i:s");
        //     $deliveryPrices->save();
        // }
        // return back()->with('success','تم إضافة سعر الجولة بشكل ناجح');

    }

    function update_round(Request $request){

        DeliveryPrices::where('id', $request->delivery_id)->update(['price' => $request->price,'updated_at' => date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تم التعديل على سعر الجولة بشكل ناجح');
    }

    public function remove_round(){
        $selected_round=Rounds::where('id', '=', $_GET['id'])->get();
        if(isset($_GET['id'])){
          Rounds::where('id', '=', $_GET['id'])->delete();
        }
        $result= Rounds::where([
            ['delivery_prices_id','=', $selected_round[0]->delivery_prices_id],

        ])->get();
        $index=1;
        foreach($result as $value) {
           Rounds::where('id', '=', $value->id)->update(['round_num' =>$index++,'updated_at' => date("Y-m-d h:i:s")]);
        }

        return $result;
    }

    public function fetch_round_price(Request $request){

            $price=DeliveryPrices::select('id','price')->where([
                ['round_capacity',$request->round_capacity],
                ['orders_num',$request->orders_num],
                ['type',$request->delivery_type],
                ['time',$request->time],

            ])->get();

        return  response()->json(['data' => $price]);
    }
    // Display region_delivery page

    public function region_delivery_screen()
    {
        $locations=DeliveryLocations::select('city')->distinct()->get();
        $main_categories= Category::whereNull('category_id')->get();
        return view('pages.delivery-screens',['locations' => $locations,'main_categories'=> $main_categories]);
    }
    public function fetch_regions(Request $request){

        $regions=DeliveryLocations::select('id','location')->where('city',$request->name)->get();
        return  response()->json(['regions' => $regions]);
    }

    public function fetch_regions_price(Request $request){
        if($request->delivery_type != "kilo") {
            $price=DeliveryPrices::select('id','price')->where([
                ['location_id',$request->location_id ],
                ['category_id',$request->category_id ],
                ['time',$request->time],

            ])->get();
        }
        // else{
        //     $price=DeliveryPrices::select('id','price')->where([
        //         ['distance',$request->distance ],
        //         ['time',$request->time],

        //     ])->get();

        // }

        return  response()->json(['data' => $price]);
    }

    function add_region_delivery(Request $request){

        if($request->timing == 'all-times'){
            // times array
            $times = array('8-10 ص' , '10-12 ص', '12-2 م', '2-4 م', '4-6 م');
            if($request->delivery_type != "kilo"){
                DeliveryPrices::where('location_id', '=', $request->region)->delete();
            }
            // else{
            //     DeliveryPrices::where('distance', '=', $request->delivery_distance)->delete();
            // }
            foreach($times as $value){
                $deliveryPrices = new DeliveryPrices;
                $deliveryPrices->type= $request->delivery_type;
                if($request->delivery_type != "kilo") {$deliveryPrices->location_id = $request->region;}
                // if($request->delivery_type == "kilo") {$deliveryPrices->distance = $request->delivery_distance;}
                $deliveryPrices->time = $value;
                $deliveryPrices->price = $request->delivery_price;
                $deliveryPrices->category_id = $request->category_id;
                $deliveryPrices->lang = $request->lang;
                $deliveryPrices->created_at= date("Y-m-d h:i:s");
                $deliveryPrices->updated_at= date("Y-m-d h:i:s");
                $deliveryPrices->save();
            }
        } else {
            $deliveryPrices = new DeliveryPrices;
            $deliveryPrices->type= $request->delivery_type;
            if($request->delivery_type != "kilo") {$deliveryPrices->location_id = $request->region;}
            // if($request->delivery_type == "kilo") {$deliveryPrices->distance = $request->delivery_distance;}
            $deliveryPrices->time = $request->timing;
            $deliveryPrices->category_id = $request->category_id;
            $deliveryPrices->price = $request->delivery_price;
            $deliveryPrices->lang = $request->lang;
            $deliveryPrices->created_at= date("Y-m-d h:i:s");
            $deliveryPrices->updated_at= date("Y-m-d h:i:s");
            $deliveryPrices->save();
        }

        return back()->with('success','تم إضافة سعر التوصيل بشكل ناجح');
    }


    function update_region_delivery(Request $request){
        DeliveryPrices::where('id', $request->delivery_id)->update([
            'price' => $request->delivery_price,
            'type'=> $request->delivery_type,
            'updated_at' => date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تم التعديل على سعر التوصيل بشكل ناجح');
    }


    /**
     * Display appPages page
     *
     * @return \Illuminate\View\View
     */
    public function app_pages()
    {
        return view('pages.app-pages');
    }

    /**
     * Display win_with_us page
     *
     * @return \Illuminate\View\View
     */
    public function win_with_us()
    {
        return view('pages.win-with-us');
    }
    /**
     * Display copons page
     *
     * @return \Illuminate\View\View
     */
    public function copons()
    {
        $products=Product::all();
        $copouns=Copouns::all();
        return view('pages.copons',['products'=>$products,'copouns'=>$copouns]);
    }

    public function add_copouns(Request $request){

        $copoun = new Copouns;
        $copoun->code= $request->code;
        $copoun->type= $request->offer_type;
        $copoun->product_id= $request->product_id;
        $copoun->value= $request->offer_value;
        $copoun->num_usage= $request->num_usage;
        $copoun->lang= $request->lang;
        $copoun->save();
        return back()->with('success','تم إضافة كوبون جديد بنجاح');

    }

    public function remove_copouns(){
        if(isset($_GET['id'])){
          Copouns::where('id', '=', $_GET['id'])->delete();
        }
        return "success!";
    }

    /**
     * Display statistics page
     *
     * @return \Illuminate\View\View
     */
    public function statistics()
    {
        return view('pages.statistics');
    }
    //  get details for offers screens based on offer name
    function offers_screens(Request $request){
        $offer_id = $request->get('offer');
        $products = Product::where('offers_ids', 'LIKE', "%$offer_id%")->limit(25)->get();
        $allproducts = Product::where('offers_ids', 'not like', "%$offer_id%")->orWhere('offers_ids', null)->get();
        return view('pages.offers-screens', compact('products', 'allproducts'));
    }

     //  add product to offer in offers screen
    function addProductToOffer(Request $request){
        $product_id = $request->get('product');
        $offer_id = $request->get('offer_id');
        $product = Product::find($product_id);
        if($product->offers_ids == null){
            $product->offers_ids = [$offer_id];
        } else {
            $offers_arr = json_decode($product->offers_ids);
            array_push($offers_arr, $offer_id);
            $product->offers_ids = $offers_arr;
        }
        $product->save();
        return "success!";
    }

    //  delete product from offer in offers screen
    function deleteOffer(Request $request){
        $product_id = $request->get('product');
        $offer_id = $request->get('offer_id');
        $product = Product::find($product_id);

        $offers_arr = json_decode($product->offers_ids);
        array_push($offers_arr, $offer_id);
        $offers_arr = array_diff($offers_arr, array($offer_id));
        $product->offers_ids = $offers_arr;

        $product->save();
        return back()
    	->with('success','تم حذف المنتج من العرض بنجاح');
    }

    function orders_screen()
    {
        $orders=Order::all();

        return view('pages.orders',["orders"=> $orders]);
    }


}
