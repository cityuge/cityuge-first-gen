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
		Asset::add('jquery.sharrre', 'js/jquery.sharrre.js', 'jquery');

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

	/**
	 * Output the XML sitemap for search engines.
	 */
	public function get_sitemap()
	{
		// Don't show the profiler bar
		Config::set('application.profiler', false);

		// Cache the XML generated for other requests
		if (!Cache::has('sitemap')) {
			Cache::forever('sitemap', $this->prepare_sitemap());
		}
		// Return the cached XML
		return Cache::get('sitemap');

		
	}

	/**
	 * Generate XML sitemap for search engines.
	 */
	private function prepare_sitemap()
	{
		$sitemap = new Sitemap();

		// Static pages
		// Home page, use the current time as the sitemap is cached
		$sitemap->add(URL::base(), date('c'), '1.0', 'hourly');
		// Use the view file's last modified date
		$sitemap->add(URL::to_route('about'), date('c', File::modified('application/views/home/about.blade.php')), '0.5', 'monthly');

		// Course detail pages
		$courses = DB::query('SELECT courses.code, comments.created_at FROM courses '
							. 'LEFT JOIN comments ON comments.course_id = courses.id '
							. 'AND comments.id IN (SELECT MAX(id) FROM comments GROUP BY comments.course_id)');
		foreach ($courses as $course) {
			// If created_at is NULL, then use the view file's last modified date
			$time = $course->created_at ? $course->created_at : date('c', File::modified('application/views/home/course/detail.blade.php'));
			$sitemap->add(URL::to_route('course.detail', array(strtolower($course->code))), $time, '0.7', 'daily');
		}

		// Latest comments page
		$sitemap->add(URL::to_route('comment'), DB::only('SELECT created_at FROM comments ORDER BY created_at DESC LIMIT 1'), '0.6', 'hourly');


		return $sitemap->render('xml');
	}

	/**
	 * Sharrre by Julien Hany
	 * @return Response JSON for the jQuery Sharrre plugin
	 */
	public function get_social_media_counter()
	{
		// Don't show the profiler bar
		Config::set('application.profiler', false);

		// Sharrre by Julien Hany
		$json = array('url'=>'','count'=>0);
		$json['url'] = $_GET['url'];
		$url = urlencode($_GET['url']);
		$type = urlencode($_GET['type']);
		
		if (filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
			if ($type == 'googlePlus') {  //source http://www.helmutgranda.com/2011/11/01/get-a-url-google-count-via-php/
				$content = $this->parse_social_media_badge("https://plusone.google.com/u/0/_/+1/fastbutton?url=".$url."&count=true");
				
				$dom = new DOMDocument;
				$dom->preserveWhiteSpace = false;
				@$dom->loadHTML($content);
				$domxpath = new DOMXPath($dom);
				$newDom = new DOMDocument;
				$newDom->formatOutput = true;
				
				$filtered = $domxpath->query("//div[@id='aggregateCount']");
				if (isset($filtered->item(0)->nodeValue)) {
					$json['count'] = str_replace('>', '', $filtered->item(0)->nodeValue);
				}
			}
			else if($type == 'stumbleupon') {
				$content = $this->parse_social_media_badge("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=$url");
				
				$result = json_decode($content);
				if (isset($result->result->views)) {
					$json['count'] = $result->result->views;
				}

			}
			else if($type == 'pinterest') {
				$content = $this->parse_social_media_badge("http://api.pinterest.com/v1/urls/count.json?callback=&url=$url");
				
				$result = json_decode(str_replace(array('(', ')'), array('', ''), $content));
				if (is_int($result->count)) {
					$json['count'] = $result->count;
				}
			}
		}
		$json = str_replace('\\/','/', $json);

		return Response::json($json);
	}

	private function parse_social_media_badge($encUrl){
		$options = array(
			CURLOPT_RETURNTRANSFER => true, // return web page
			CURLOPT_HEADER => false, // don't return headers
			CURLOPT_FOLLOWLOCATION => false, // follow redirects
			CURLOPT_ENCODING => "", // handle all encodings
			CURLOPT_USERAGENT => 'sharrre', // who am i
			CURLOPT_AUTOREFERER => true, // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
			CURLOPT_TIMEOUT => 10, // timeout on response
			CURLOPT_MAXREDIRS => 3, // stop after 10 redirects
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false,
		);
		$ch = curl_init();
		
		$options[CURLOPT_URL] = $encUrl;  
		curl_setopt_array($ch, $options);
		
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		
		curl_close($ch);
		
		if ($errmsg != '' || $err != '') {
			//print_r($errmsg);
		}
		return $content;
	}
}