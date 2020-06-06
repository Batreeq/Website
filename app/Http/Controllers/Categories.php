<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\MainCategories;
use App\Homeblocks;

class Categories extends Controller
{
    function index(){
    	
        // $data= Category::whereNull('category_id')->get();
        // $data =MainCategories::all();
        $data_home_blocks= Homeblocks::all();
        $sub_categories=Category::all();
        return view("pages.category",["sub_categories"=>$sub_categories,'data_home_blocks'=>$data_home_blocks]);
    }
    function add_sub_category(Request $request)
    {
        $validatedData = $request->validate([

            'category_name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->category_name; 
        $category->home_blocks = $request->home_blocks; 
        $category->lang = $request->lang; 
        $category->created_at= date("Y-m-d h:i:s");
        $category->updated_at= date("Y-m-d h:i:s");
        $category->save();

        $data= Category::all();

        return back()
        ->with('data',$data);
        // return view("pages.category",["data"=> $data]);
    }

    function edit_sub_category(Request $request){
        Category::where('id', $request->category_id)->update([
            'name' => $request->category_name,
            'home_blocks' => $request->home_blocks,
            'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم تعديل التصنيف بنجاح');
    }

    function remove_sub_category(){
        if(isset($_GET['id'])){
          Category::where('id', '=', $_GET['id'])->delete();
        }
        return "success!"; 
    }
}
