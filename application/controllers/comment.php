<?php

class Comment_Controller extends Base_Controller {

	public function get_index()
	{
		$data = array(
			'title' => __('app.comment'),
			'comments' => Comment::with('course')
								->order_by('created_at', 'DESC')
								->paginate(Config::get('app.paginate_comment_per_page')),
		);
		return View::make('home.comment.index')->with($data);
	}

	public function get_new($course_code)
	{
		$course_code = strtoupper($course_code);
		$course = Course::where('code', '=', $course_code)->first();

		if (!$course) {
			return Response::error('404');
		}

		$grades = Course::get_grading_option_array($course->grading_pattern);

		$data = array(
			'title' => __('app.comment_new_title', array('course_code' => $course->code)),
			'course' => $course,
			'semesters' => Comment::$semester_values,
			'workloads' => Comment::get_workload_options(),
			'grades' => $grades,
		);
		return View::make('home.comment.new')->with($data);
	}

	public function post_index()
	{
		// Get the course ID in the form
		$course_id = Input::get('course_id');
		if (!$course_id) {
			return Response::error('500');
		}

		// Get the grading pattern for that course
		$course = Course::find($course_id);

		Comment::$rules['semester'] .= implode(',', array_keys(Comment::$semester_values));
		if ($course->grading_pattern === 'PF') {
			Comment::$rules['grade'] .= implode(',', Course::$pf_grading);
		} else if ($course->grading_pattern === 'STD-PF') {
			Comment::$rules['grade'] .= implode(',', Course::$std_pf_grading);
		} else {
			Comment::$rules['grade'] .= implode(',', Course::$std_grading);
		}
		$validation = Comment::validate(Input::all());

		if ($validation->passes()) {
			Comment::create(array(
				'course_id' => Input::get('course_id'),
				'semester' => Input::get('semester'),
				'instructor' => Input::get('instructor'),
				'grade' => Input::get('grade'),
				'workload' => Input::get('workload'),
				'comment' => Input::get('comment'),
				'approved' => 1,
				// Use the IP provided by CloudFlare if $_SERVER has HTTP_CF_CONNECTING_IP
				'ip_address' => Request::server('HTTP_CF_CONNECTING_IP') ? Request::server('HTTP_CF_CONNECTING_IP') : Request::server('REMOTE_ADDR'),
				'approved_at' => date('Y-m-d H:i:s'),
			));

			// Fire an event
			Event::fire('app.new_comment', array(Input::get('course_id')));

			return Redirect::to_route('course.detail', array(strtolower($course->code)))
						->with('alert_type', 'success')
						->with('alert_body', __('app.comment_created'));
		} else {
			return Redirect::to_route('comment.new', array(strtolower($course->code)))
						->with_errors($validation)
						->with_input();
		}
	}

	/**
	 * Get the site RSS feed.
	 *
	 * Always use cached feed.
	 */
	public function get_latest_comment_feed()
	{
		// Don't show the profiler bar
		Config::set('application.profiler', false);

		// Cache the XML generated for other requests
		if (!Cache::has('feed')) {
			Cache::forever('feed', $this->prepare_latest_comment_feed());
		}
		// Return the cached XML
		return Cache::get('feed');
	}

	/**
	 * Prepare the RSS feed for latest comments.
	 */
	private function prepare_latest_comment_feed() {
		$posts = Comment::with('course')->order_by('created_at', 'DESC')->take(Config::get('app.feed_max_item'))->get();

		// first get a new instance
		$feed = new Feed();

		// set your feed's title, description, link, pubdate and language
		$feed->title = __('app.feed_title');
		$feed->description = __('app.feed_description');
		$feed->link = URL::to_route('feed');
		$feed->site_link = URL::base();
		$feed->pubdate = $posts ? $posts[0]->created_at : date('c');
		$feed->lang = 'zh-HK';
		$feed->charset = 'utf-8';
		$feed->generator = __('app.app_title');

		$author = 'cityuge@swiftzer.net (' . __('app.app_title') . ')';
		foreach ($posts as $post) {
			$comment = '<dl><dt>' . __('app.comment_instructor') . '</dt><dd>' . e($post->instructor) . '</dd>'
						. '<dt>' . __('app.comment_grade') . '</dt><dd>' . Course::get_grade_text($post->grade) . '<dd>'
						. '<dt>' . __('app.comment_workload') . '</dt><dd>' . Comment::get_workload_text($post->workload) . '</dd></dl>'
						. $post->comment;
			$title = $post->course->code . ' - ' . $post->course->title_en;
			// set item's title, author, url, pubdate and description
			$feed->add($title, $author, URL::to_route('course.detail', strtolower($post->course->code)). '/#comment-' . $post->id, $post->created_at, $comment);
		}

		// show your feed (options: 'atom' (recommended) or 'rss')
		return $feed->render('rss');
	}

	/**
	 * Get the site RSS feed of a specific course.
	 *
	 * Always use cached feed.
	 */
	public function get_latest_course_comment_feed($course_code) {
		// Don't show the profiler bar
		Config::set('application.profiler', false);

		if (!$course = Course::check_course_code($course_code)) {
			return Response::error('404');
		}

		// Cache the XML generated for other requests
		if (!Cache::has('feed_' . $course->id)) {
			Cache::forever('feed_' . $course->id, $this->prepare_latest_course_comment_feed($course));
		}
		// Return the cached XML
		return Cache::get('feed_' . $course->id);

		
	}

	/**
	 * Prepare the RSS feed for latest comments of a specific course.
	 */
	private function prepare_latest_course_comment_feed($course) {
		$posts = Comment::where('course_id', '=', $course->id)->order_by('created_at', 'DESC')->take(Config::get('app.feed_max_item'))->get();

		// first get a new instance
		$feed = new Feed();

		// set your feed's title, description, link, pubdate and language
		$feed->title = __('app.feed_course_title', array('course_code' => $course->code));
		$feed->description = __('app.feed_course_description', array('course_code' => $course->code));
		$feed->link = URL::to_route('course.feed', array(strtolower($course->code)));
		$feed->site_link = URL::base();
		$feed->pubdate = $posts ? $posts[0]->created_at : date('c');
		$feed->lang = 'zh-HK';
		$feed->charset = 'utf-8';
		$feed->generator = __('app.app_title');

		$author = 'cityuge@swiftzer.net (' . __('app.app_title') . ')';
		foreach ($posts as $post) {
			$title = $course->code . ' - ' . $course->title_en;
			// insert the instructor, grade and workload before the comment
			$comment = '<dl><dt>' . __('app.comment_instructor') . '</dt><dd>' . e($post->instructor) . '</dd>'
					. '<dt>' . __('app.comment_grade') . '</dt><dd>' . Course::get_grade_text($post->grade) . '<dd>'
					. '<dt>' . __('app.comment_workload') . '</dt><dd>' . Comment::get_workload_text($post->workload) . '</dd></dl>'
					. $post->comment;
			// set item's title, author, url, pubdate and description
			$feed->add($title, $author, URL::to_route('course.detail', strtolower($course->code)). '/#comment-' . $post->id, $post->created_at, $comment);
		}

		// show your feed (options: 'atom' (recommended) or 'rss')
		return $feed->render('rss');
	}

}