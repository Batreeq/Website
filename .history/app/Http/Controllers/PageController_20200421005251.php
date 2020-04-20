<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homeblocks;
use App\Product;

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
        return back()
    	->with('success','تم حذف المنتج بنجاح');
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
        return "success!";
    }

}
