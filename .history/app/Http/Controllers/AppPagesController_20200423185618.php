<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivacyPolicy;
use App\Terms;
use App\Help;

class AppPagesController extends Controller
{
    function terms(){
        $data =Terms::get();
        return view('pages.terms',["data"=> $data]);

    }

    function submit_add(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $terms = new Terms;
        $terms->title = $request->title;
        $terms->text = $request->text;
        $terms->created_at =date("Y-m-d h:i:s");
        $terms->save();

        return back()
    	->with('success','تمت إضافة السياسة العامة  بنجاح');

    }
    function submit_update(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        Terms::where('id', $request->id)->update(['title' => $request->title,'text' => $request->text,'updated_at'=>date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تمت تعديل السياسة العامة بنجاح');
    }

    function privacy_policy(){

        $data =PrivacyPolicy::get();
        return view('pages.privacy-policy',["data"=> $data]);
    }

    function submit_add_privacy_policy(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'text' => 'required',
	    ]);

        $privacyPolicy = new PrivacyPolicy;
        $privacyPolicy->title = $request->title;
        if(isset(request()->image)){
            $privacyPolicy->image = 'https://jaraapp.com/images/';
        }
        $privacyPolicy->text = $request->text;
        $privacyPolicy->created_at =date("Y-m-d h:i:s");
        $privacyPolicy->save();

    	return back()
    	->with('success','تمت إضافة الخصوصية والأمان  بنجاح');
    }
    function submit_update_privacy_policy(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        PrivacyPolicy::where('id', $request->id)->update(['title' => $request->title,'text' => $request->text,'updated_at'=>date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تمت تعديل الخصوصية والأمان  بنجاح');
    }

    function help(){

        $data =Help::get();
        return view('pages.help',["data"=> $data]);
    }

    function submit_add_help(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $help = new Help;
        $help->title = $request->title;
        $help->text = $request->text;
        $help->created_at =date("Y-m-d h:i:s");
        $help->save();

        return back()
        ->with('success','تمت إضافة المساعدة بنجاح');
    }
    function submit_update_help(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        Help::where('id', $request->id)->update(['title' => $request->title,'text' => $request->text,'updated_at'=>date("Y-m-d h:i:s")]);

        return back()
        ->with('success','تمت تعديل المساعدة بنجاح');
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
    	->with('success','تمت إضافة المساعدة بنجاح');
    }
}
