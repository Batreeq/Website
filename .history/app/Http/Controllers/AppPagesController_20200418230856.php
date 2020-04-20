<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
