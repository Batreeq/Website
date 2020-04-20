<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class AppPagesController extends Controller
{
    function security(){
        return view('pages.security');
    }

    function submit_add(Request $request){

        $validatedData = $request->validate([
	        'title' => 'required',
	        'description' => 'required',

	    ]);


    	return back()
    	->with('success','تمت إضافة السياسة والخصوصية بنجاح');
    }

    function policy(){
        return view('pages.policy');
    }

    function submit_add_policy(Request $request){

        $validatedData = $request->validate([
	        'title' => 'required',
	        'description' => 'required',

	    ]);


    	return back()
    	->with('success','تمت إضافة السياسة العامة  بنجاح');
    }

     function question(){
        return view('pages.question');
    }

    function submit_add_question(Request $request){

        $validatedData = $request->validate([
	        'title' => 'required',
	        'description' => 'required',

	    ]);

    	return back()
    	->with('success','تمت إضافة أسئلة شائعة  بنجاح');
    }

    //  get details for offers screens based on offer name
    function offers_screens(Request $request){

    	return view('pages.offers-screens', compact(''));
    }

     function question(){
        return view('pages.question');
    }
}