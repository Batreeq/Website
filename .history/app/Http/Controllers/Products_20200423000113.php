<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Homeblocks;

class Products extends Controller
{
    function index(){

        $data= Product::all();
        $data_categories= Category::all();
        return view('pages.products',["data"=> $data,"data_categories"=> $data_categories]);
    }
    function add(){

        $data= Product::all();
        $data_categories= Category::all();
        return view('pages.product-add',["data"=> $data,"data_categories"=> $data_categories]);
    }

    public function add_offer(Request $request){

       $offer = new Homeblocks;
       request()->validate([
          'name' => 'required',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $imageName = time().'.'.request()->image->getClientOriginalExtension();
      request()->image->move(public_path('images'), $imageName);

      $product->name = $request->name;
      $product->category_id = $request->product_category;
      $product->size = $request->product_size;
      $product->price = $request->product_price;
      $product->quantity = $request->product_quantity;
      $product->details_text = $request->product_details_text;
      $product->details_title = $request->product_details_title;
      $product->notice = $request->product_notice;
      $product->image = $imageName;
      $product->details_image = $imageDetailsName;
      $product->product_source = "";
      $product->special_price = $special_price;
      $product->special_price_for = $special_price_for;
      $product->created_at= date("Y-m-d", $t);
      $product->save();

      return back()->with('success','تمت إضافة العرض بشكل ناجح')->with('image',$imageName);

  }

    public function submit_add (Request $request){
          $t=time();

    	 $validatedData = $request->validate([

	        'product_name' => 'required',
	        'product_size' => 'required',
	        'product_quantity' => 'required',
	        'product_price' => 'required',
	        'product_details_text' => 'required',
	        'product_details_title' => 'required',
	        'product_notice' => 'required',
	        'product_image' => 'required',
	        'product_details_image' => 'required',
            'product_category' => 'required',


	    ]);

    	 $product = new Product;
         request()->validate([

            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_details_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('images'), $imageName);

        $imageDetailsName = time().'.'.request()->product_details_image->getClientOriginalExtension();
        request()->product_details_image->move(public_path('images'), $imageDetailsName);
        if($request->product_special_price == null){
            $special_price=0;
        }else{
            $special_price=$request->product_special_price;
        }
        if($request->product_special_price_for == null){
            $special_price_for=0;
        }else{
            $special_price_for=$request->product_special_price_for;
        }
        $product->name = $request->product_name;
        $product->category_id = $request->product_category;
        $product->size = $request->product_size;
        $product->price = $request->product_price;
        $product->quantity = $request->product_quantity;
        $product->details_text = $request->product_details_text;
        $product->details_title = $request->product_details_title;
        $product->notice = $request->product_notice;
        $product->image = $imageName;
        $product->details_image = $imageDetailsName;
        $product->product_source = "";
        $product->special_price = $special_price;
        $product->special_price_for = $special_price_for;
        $product->created_at= date("Y-m-d", $t);
        $product->save();

        return back()

            ->with('success','تمت إضافة المنتج بشكل ناجح')

            ->with('image',$imageName);

    }


}
