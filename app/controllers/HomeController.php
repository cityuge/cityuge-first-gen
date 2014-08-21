<?php

class HomeController extends BaseController
{
    /**
     * Show the home page.
     */
    public function index()
    {
        $data = array(
            'metaDescription' => Lang::get('app.meta_homeDesc'),
        );

        return View::make('home.index')->with($data);
    }

    /**
     * Show the statistics page.
     */
    public function stats()
    {
        $data = array(
            'title' => trans('app.stat_title'),
            'metaDescription' => Lang::get('app.stat_metaDesc'),
            'stats' => Course::getCourseStats(),
        );

        return View::make('home.stats')->with($data);
    }

    /**
     * Show about us page.
     */
    public function about()
    {
        $data = array(
            'title' => Lang::get('app.about'),
            'meta_description' => Lang::get('app.meta_aboutDesc'),
        );

        return View::make('home.about')->with($data);
    }

}
