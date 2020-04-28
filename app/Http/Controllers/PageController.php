<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homeblocks;
use App\Product;
use App\Order;
use App\DeliveryLocations;
use App\DeliveryPrices;

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

    /**
     * Display Work us page
     *
     * @return \Illuminate\View\View
     */
    public function work_us()
    {
        return view('pages.work-us');
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
    public function users()
    {
        return view('pages.users');
    }

    /**
     * Display delivery page
     *
     * @return \Illuminate\View\View
     */
    public function delivery()
    {
        return view('pages.delivery');
    }
    // Display region_delivery page

    public function region_delivery_screen()
    {
        $locations=DeliveryLocations::select('city')->distinct()->get();
        return view('pages.region-delivery',['locations' => $locations]);
    }
    function fetch_regions(Request $request){
      
        $regions=DeliveryLocations::select('id','location')->where('city',$_GET['name'])->get();
        return  response()->json(['regions' => $regions]);
    }
    function add_region_delivery(Request $request){

        $validatedData = $request->validate([

            'city' => 'required',
            'timing' => 'required',
            'region' => 'required',
            'delivery_price' => 'required',

        ]);

        $deliveryPrices = new DeliveryPrices;
        $deliveryPrices->location_id = $request->region;
        $deliveryPrices->time = $request->timing;
        $deliveryPrices->price = $request->delivery_price;
        $deliveryPrices->created_at= date("Y-m-d h:i:s");
        $deliveryPrices->updated_at= date("Y-m-d h:i:s");
        $deliveryPrices->save();
        return back()->with('success','تمت إضافة سعر التوصيل بشكل ناجح');
      
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
        return view('pages.copons');
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
