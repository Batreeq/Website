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

        $category->save();
        $data= Category::all();
        return back()
        ->with('data',$data);
        // return view("pages.category",["data"=> $data]);
    }
}
