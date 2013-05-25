<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function get_index()
	{
		$data = array(
			'hot_courses_area1' => Course::get_hot_courses('AREA1', Config::get('app.home_stats_max_item')),
			'hot_courses_area2' => Course::get_hot_courses('AREA2', Config::get('app.home_stats_max_item')),
			'hot_courses_area3' => Course::get_hot_courses('AREA3', Config::get('app.home_stats_max_item')),

			'good_grade_courses_area1' => Course::get_good_grade_courses('AREA1', Config::get('app.home_stats_max_item')),
			'good_grade_courses_area2' => Course::get_good_grade_courses('AREA2', Config::get('app.home_stats_max_item')),
			'good_grade_courses_area3' => Course::get_good_grade_courses('AREA3', Config::get('app.home_stats_max_item')),

			'bad_grade_courses_area1' => Course::get_bad_grade_courses('AREA1', Config::get('app.home_stats_max_item')),
			'bad_grade_courses_area2' => Course::get_bad_grade_courses('AREA2', Config::get('app.home_stats_max_item')),
			'bad_grade_courses_area3' => Course::get_bad_grade_courses('AREA3', Config::get('app.home_stats_max_item')),

			'light_workload_courses_area1' => Course::get_light_workload_courses('AREA1', Config::get('app.home_stats_max_item')),
			'light_workload_courses_area2' => Course::get_light_workload_courses('AREA2', Config::get('app.home_stats_max_item')),
			'light_workload_courses_area3' => Course::get_light_workload_courses('AREA3', Config::get('app.home_stats_max_item')),

			'heavy_workload_courses_area1' => Course::get_heavy_workload_courses('AREA1', Config::get('app.home_stats_max_item')),
			'heavy_workload_courses_area2' => Course::get_heavy_workload_courses('AREA2', Config::get('app.home_stats_max_item')),
			'heavy_workload_courses_area3' => Course::get_heavy_workload_courses('AREA3', Config::get('app.home_stats_max_item')),

			'meta_description' => __('app.meta_home_desc'),
		);
		return View::make('home.index')->with($data);
	}

	public function get_about()
	{
		$data = array(
			'title' => __('app.about'),
			'meta_description' => __('app.meta_about_desc'),
		);
		return View::make('home.about')->with($data);
	}

}