<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\MainCategories;

class Categories extends Controller
{
    function index(){
    	
        // $data= Category::whereNull('category_id')->get();
        $data =MainCategories::all();
      
        return view("pages.category",["data"=> $data]);
    }
    function sub_categories(){
        
        // $main_categories= Category::whereNull('category_id')->get();
        $main_categories =MainCategories::all();
        $sub_categories=Category::where('category_id',"!=","null")->get();
      
        return view("pages.sub-categories",["data_categories"=> $main_categories,"sub_categories"=>$sub_categories]);
    }
    function add_sub_category(Request $request)
    {
        $validatedData = $request->validate([

            'category_name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->category_name; 
        $category->category_id = $request->category_id; 
        $category->lang = $request->lang; 
        $category->created_at= date("Y-m-d h:i:s");
        $category->updated_at= date("Y-m-d h:i:s");
        $category->save();

        $data= Category::all();

        return back()
        ->with('data',$data);
        // return view("pages.category",["data"=> $data]);
    }


    function add(Request $request)
    {
    
        $validatedData = $request->validate([
	        'category_name' => 'required',
	    ]);
        $category = new MainCategories;
        $category->name = $request->category_name; 
        $category->lang = $request->lang; 
        $category->created_at= date("Y-m-d h:i:s");
        $category->updated_at= date("Y-m-d h:i:s");
        $category->save();
        $data= MainCategories::all();
        return back()->with('data',$data);
        // return view("pages.category",["data"=> $data]);
    }

    function edit_category(Request $request){
        MainCategories::where('id', $request->category_id)->update([
            'name' => $request->category_name,
            'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم تعديل التصنيف بنجاح');
    }

    function edit_sub_category(Request $request){
        Category::where('id', $request->category_id)->update([
            'name' => $request->category_name,
            'category_id' => $request->main_category,
            'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم تعديل التصنيف بنجاح');
    }
    function remove_category(){
        if(isset($_GET['id'])){
          MainCategories::where('id', '=', $_GET['id'])->delete();
        }
        return "success!"; 
    }
    function remove_sub_category(){
        if(isset($_GET['id'])){
          Category::where('id', '=', $_GET['id'])->delete();
        }
        return "success!"; 
    }
}
