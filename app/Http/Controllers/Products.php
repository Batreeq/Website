<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Homeblocks;
use App\Offer;
use App\MainCategories;

class Products extends Controller
{
    function index(){

        $data= Product::all();
        $data_categories= Category::all();
        return view('pages.products',["data"=> $data,"data_categories"=> $data_categories]);
    }
    function add(){
       $data_categories= Category::all();
       $data_product=null;
       if(isset($_GET['id'])){
         $data_product= Product::where('id','=',$_GET['id'])->get();
       }
        
        return view('pages.product-add',["data_product"=>$data_product, "data_categories"=> $data_categories]); 
    }

    

    public function add_offer(Request $request){

        request()->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(isset($request->offer_id)){
            $offer = Homeblocks::find($request->offer_id);
            if(isset(request()->image)){
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('online'), $imageName);
                $offer->image = 'https://jaraapp.com/online/'. $imageName;
            }
            $offer->name = $request->name;
            $offer->save();
            return back()->with('success','تمت إضافة العرض بشكل ناجح');
        } else {
            $offer = new Homeblocks;
            if(isset(request()->image)){
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('online'), $imageName);
                $offer->image = 'https://jaraapp.com/online/'. $imageName;
            }
            $offer->name = $request->name;
            $offer->lang = $request->lang;
            $offer->save();
            return back()->with('success','تمت إضافة العرض بشكل ناجح')->with('image',$imageName);
        }
    }

    public function delete_offer(Request $request){
        $offer = Homeblocks::find($request->offer)->delete();
        return "success!";
    }
    public function remove_product(Request $request){
       
        if(isset($_GET['id'])){
            Product::where('id', '=',$_GET['id'])->delete();
        }
         return "success!";     
    }

    public function edit_product(Request $request){

        $productImage=$request->old_product_image;
        $productDetailsImage=$request->old_details_image;

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

        if(isset(request()->product_image)){
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            request()->product_image->move(public_path('images'), $imageName);
            $productImage= "https://".$_SERVER['HTTP_HOST'].'/images/'.$imageName;
        }

         
        if(isset(request()->product_details_image)){
            $detailsImageName = time().'.'.request()->product_details_image->getClientOriginalExtension();
            request()->product_details_image->move(public_path('images'), $detailsImageName);
            $productDetailsImage= "https://".$_SERVER['HTTP_HOST'].'/images/'.$detailsImageName;
        }
        if($request->product_package == null){
            $is_package="false";
        }else{
            $is_package="true";
        }

        Product::where('id', $request->product_id)->update([
            'name'=>$request->product_name,
            'category_id'=>$request->product_category,
            'size'=>$request->product_size,
            'image'=>$productImage,
            'details_image'=>$productDetailsImage,
            'price'=>$request->product_price,
            'quantity'=>$request->product_quantity,
            'details_text'=> $request->product_details_text,
            'details_title'=>$request->product_details_title,
            'notice'=>$request->product_notice,
            'wholesale_price'=>$request->product_wholesale_price,
            'product_source'=>"",
            'is_package'=> $is_package,
            // 'special_price'=> $special_price,
            'special_price_for'=>$special_price_for,
            // 'copons' => $request->product_copons,
            'points'=>$request->product_point,
            'barcode'=>$request->product_barcode,
            'updated_at' => date("Y-m-d h:i:s")]);

        return back()->with('success','تم تعديل معلومات المنتج بنجاح');
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
            'product_wholesale_price' => 'required',
            'product_point' => 'required',
            // 'product_copons' => 'required',
            'product_barcode' => 'required'

	    ]);

    	$product = new Product;
        request()->validate([

            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_details_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        if(isset(request()->product_image)){
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            request()->product_image->move(public_path('images'), $imageName);
            $productImage= "https://".$_SERVER['HTTP_HOST'].'/images/'.$imageName;
        }

         
        if(isset(request()->product_details_image)){
            $detailsImageName = time().'.'.request()->product_details_image->getClientOriginalExtension();
            request()->product_details_image->move(public_path('images'), $detailsImageName);
            $productDetailsImage= "https://".$_SERVER['HTTP_HOST'].'/images/'.$detailsImageName;
        } 

        $Category= Category::where('id','=',$request->product_category)->get();
        $mainCategory= MainCategories::where('id','=',$Category[0]->category_id)->get();

        // $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
        // request()->product_image->move(public_path('images'), $imageName);

        // $imageDetailsName = time().'.'.request()->product_details_image->getClientOriginalExtension();
        // request()->product_details_image->move(public_path('images'), $imageDetailsName);

        // if($request->product_special_price == null){
        //     $special_price=0;
        // }else{
        //     $special_price=$request->product_special_price;
        // }
        if($request->product_special_price_for == null){
            $special_price_for=0;
        }else{
            $special_price_for=$request->product_special_price_for;
        }
        // $copons = Product::where('copons','=',$request->product_copons)->first();


        // if($copons==null){
            $product->name = $request->product_name;
            $product->category_id = $request->product_category;
            $product->main_category=$mainCategory[0]->name;
            $product->size = $request->product_size;
            $product->price = $request->product_price;
            $product->quantity = $request->product_quantity;
            $product->details_text = $request->product_details_text;
            $product->details_title = $request->product_details_title;
            $product->notice = $request->product_notice;
            $product->image = $productImage;
            $product->details_image = $productDetailsImage;
            $product->wholesale_price= $request->product_wholesale_price;
            $product->product_source = "";
            // $product->special_price = $special_price;
            $product->special_price_for = $special_price_for;
            $product->created_at= date("Y-m-d h:i:s");
            $product->updated_at= date("Y-m-d h:i:s");
            $product->points= $request->product_point;
            $product->barcode=$request->product_barcode;
            // $product->copons= $request->product_copons;
            $product->lang= $request->lang;
            if($request->product_package == null){
                $product->is_package="false";
            }else{
                $product->is_package="true";
            }
            
            $product->save();
            return back()
                ->with('success','تمت إضافة المنتج بشكل ناجح')
                ->with('image',$imageName);


    }
        //  get on special offer screens
    function specail_offer_screen(Request $request){
        $product_id = $request->get('id');
        $product = Product::where('id', $product_id)->get();
        return view('pages.special-offer',["product"=> $product]);
    }
     //  add special offer to product
    function addSpecialOffer(Request $request){

        $validatedData = $request->validate([
            'offer_type' => 'required',
            'product_special_price_for' => 'required',
            'product_special_price' => 'required',
            'datepicker' => 'required',
            'datepicker_end' => 'required',
            'offer_region' => 'required',

        ]);

        $offer = new Offer;
        $offer->product_id = $request->product_id; 
        $offer->price = $request->product_special_price; 
        $offer->created_at= date("Y-m-d h:i:s");
        $offer->updated_at= date("Y-m-d h:i:s");
        $offer->start_date=$request->datepicker;
        $offer->end_date=$request->datepicker_end;
        $offer->based_on=$request->product_special_price_for;
        $offer->min_quantity=$request->min_quantity;
        $offer->max_quantity=$request->max_quantity;
        $offer->region=$request->offer_region;
        $offer->based_type=$request->offer_type;
        $offer->lang=$request->lang;
        $offer->save();


        return back()->with('success','تمت إضافة العرض بشكل ناجح');

    }
    function update_copons(Request $request){

        $copons = Product::where('copons','=',$request->product_new_copons)->first();
        if($copons==null){
            Product::where('id', $request->product_old_copons)->update(['copons' => $request->product_new_copons,'updated_at' => date("Y-m-d h:i:s")]);

            return back()
            ->with('success','تم تعديل الكوبون بنجاح');
        }else{
            return back()

                ->with('error','الكوبون الذي تمت إضافته موجود مسبقا, الرجاء إدخال رقم آخر');

        }

    }


}
