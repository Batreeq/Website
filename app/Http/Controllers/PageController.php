<?php

namespace App\Http\Controllers;

class PageController extends Controller
{ 

    /**
     * Display products page
     *
     * @return \Illuminate\View\View
     */
    public function products()
    {
        return view('pages.products');
    }

    /**
     * Display Work us page
     *
     * @return \Illuminate\View\View
     */
    public function work_us()
    {
        return view('pages.work-us');
    }

    /**
     * Display different parts page
     *
     * @return \Illuminate\View\View
     */
    public function different_parts()
    {
        return view('pages.different-parts');
    }
    
    /**
     * Display users page
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        return view('pages.users');
    }

    /**
     * Display delivery page
     *
     * @return \Illuminate\View\View
     */
    public function delivery()
    {
        return view('pages.delivery');
    }

    /**
     * Display appPages page
     *
     * @return \Illuminate\View\View
     */
    public function app_pages()
    {
        return view('pages.app-pages');
    }

    /**
     * Display win_with_us page
     *
     * @return \Illuminate\View\View
     */
    public function win_with_us()
    {
        return view('pages.win-with-us');
    }
    /**
     * Display copons page
     *
     * @return \Illuminate\View\View
     */
    public function copons()
    {
        return view('pages.copons');
    }
    /**
     * Display statistics page
     *
     * @return \Illuminate\View\View
     */
    public function statistics()
    {
        return view('pages.statistics');
    }

   
}
