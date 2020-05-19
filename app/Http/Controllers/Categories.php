<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class Categories extends Controller
{
     function index(){
    	
        $data= Category::all();
      
        return view("pages.category",["data"=> $data]);
    }

    function add(Request $request)
    {
    
        $validatedData = $request->validate([

	        'category_name' => 'required',
	    ]);

        $category = new Category;

        $category->name = $request->category_name; 
        $category->lang = $request->lang; 

        $category->save();
        $data= Category::all();
        return back()
        ->with('data',$data);
        // return view("pages.category",["data"=> $data]);
    }

    function edit_category(Request $request){
        Category::where('id', $request->category_id)->update([
            'name' => $request->category_name,
            'updated_at' => date("Y-m-d h:i:s")]);
        return back()
        ->with('success','تم تعديل التصنيف بنجاح');
    }

    function remove_category(){
        if(isset($_GET['id'])){
          Category::where('id', '=', $_GET['id'])->delete();
        }
        return "success!"; 
    }
}
