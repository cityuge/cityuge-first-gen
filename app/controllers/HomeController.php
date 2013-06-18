<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$data = array(
			'hotCoursesArea1' => Course::getHotCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
			'hotCoursesArea2' => Course::getHotCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
			'hotCoursesArea3' => Course::getHotCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

			'goodGradeCoursesArea1' => Course::getGoodGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
			'goodGradeCoursesArea2' => Course::getGoodGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
			'goodGradeCoursesArea3' => Course::getGoodGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

			'badGradeCoursesArea1' => Course::getBadGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
			'badGradeCoursesArea2' => Course::getBadGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
			'badGradeCoursesArea3' => Course::getBadGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

			'lightWorkloadCoursesArea1' => Course::getLightWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
			'lightWorkloadCoursesArea2' => Course::getLightWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
			'lightWorkloadCoursesArea3' => Course::getLightWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

			'heavyWorkloadCoursesArea1' => Course::getHeavyWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
			'heavyWorkloadCoursesArea2' => Course::getHeavyWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
			'heavyWorkloadCoursesArea3' => Course::getHeavyWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

			'metaDescription' => Lang::get('app.meta_homeDesc'),
		);
		return View::make('home.index')->with($data);
	}

	public function about()
	{
		$data = [
			'title' => Lang::get('app.about'),
			'meta_description' => Lang::get('app.meta_aboutDesc'),
		];
		return View::make('home.about')->with($data);
	}

	/**
	 * Sharrre by Julien Hany
	 * @return Response JSON for the jQuery Sharrre plugin
	 */
	public function socialMediaCounter()
	{
		// Sharrre by Julien Hany
		$json = array('url'=>'','count'=>0);
		$json['url'] = $_GET['url'];
		$url = urlencode($_GET['url']);
		$type = urlencode($_GET['type']);
		
		if (filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
			if ($type == 'googlePlus') {  //source http://www.helmutgranda.com/2011/11/01/get-a-url-google-count-via-php/
				$content = $this->parseSocialMediaBadge("https://plusone.google.com/u/0/_/+1/fastbutton?url=".$url."&count=true");
				
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
				$content = $this->parseSocialMediaBadge("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=$url");
				
				$result = json_decode($content);
				if (isset($result->result->views)) {
					$json['count'] = $result->result->views;
				}

			}
			else if($type == 'pinterest') {
				$content = $this->parseSocialMediaBadge("http://api.pinterest.com/v1/urls/count.json?callback=&url=$url");
				
				$result = json_decode(str_replace(array('(', ')'), array('', ''), $content));
				if (is_int($result->count)) {
					$json['count'] = $result->count;
				}
			}
		}
		$json = str_replace('\\/','/', $json);

		return Response::json($json);
	}

	private function parseSocialMediaBadge($encUrl){
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