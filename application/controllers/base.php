<?php

class Base_Controller extends Controller {

	public $restful = true;
	
	public function __construct()
	{
		// Assets
		Asset::add('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		Asset::add('bootstrap-js', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js', 'jquery');
		Asset::add('bootstrap-css', 'css/bootstrap.css');
		Asset::add('bootstrap-css-responsive', 'css/bootstrap-responsive.css', 'global');
		Asset::add('global', 'css/global.css', 'bootstrap-css');
		//Asset::add('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700');
		parent::__construct();
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}