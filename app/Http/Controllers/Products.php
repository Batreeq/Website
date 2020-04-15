<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class Products extends Controller
{
    function index(){
    	
        $data= Product::all();
        $data_categories= Category::all();
        return view('pages.products',["data"=> $data,"data_categories"=> $data_categories]);
    }

    public function add (Request $request){

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

	        
	    ]);

    	 $product = new Product;
         request()->validate([

            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('images'), $imageName);

        $product->name = $request->product_name;
        $product->category_id = $request->product_details_text;
        $product->size = $request->product_size;
        $product->price = $request->product_price;
        $product->quantity = $request->product_quantity;
        $product->details_text = $request->product_details_text;
        $product->details_title = $request->product_details_title;
        $product->notice = $request->product_notice;
        $product->image = $imageName;
        $product->details_image = $imageName;
        $product->save();
        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);

    }


}
