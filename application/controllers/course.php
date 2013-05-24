<?php

class Course_Controller extends Base_Controller {

	public function get_index()
	{
		$data = array(
			'title' => __('app.course'),
			'courses' => DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->left_join('comments', 'courses.id', '=', 'comments.course_id')
							->group_by('courses.id')
							->order_by('courses.code', 'ASC')
							->paginate(Config::get('app.paginate_per_page')),
		);
		return View::make('home.course.index')->with($data);
	}

	public function get_category($category_url)
	{
		$category_index = array_search($category_url, Course::$category_url);
		if ($category_index === false) {
			return Response::error('404');
		}
		$category = Course::$category[$category_index];

		$data = array(
			'title' => Course::get_category_title($category),
			'courses' => DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->left_join('comments', 'courses.id', '=', 'comments.course_id')
							->where('category', '=', $category)
							->group_by('courses.id')
							->order_by('courses.code', 'ASC')
							->paginate(Config::get('app.paginate_per_page')),
		);
		return View::make('home.course.index')->with($data);
	}

	public function get_detail($course_code)
	{
		$course_code = strtoupper($course_code);
		$course = Course::with('department')
						->where('code', '=', $course_code)
						->first();
		if (!$course) {
			return Response::error('404');
		}

		$comments = Comment::where('course_id', '=', $course->id)
						->order_by('created_at', 'DESC')
						->paginate(Config::get('app.paginate_comment_per_page'));

		$workload_rate = DB::table('comments')
						->where('course_id', '=', $course->id)
						->avg('workload') / 5 * 100;

		$total_comment = DB::table('comments')
						->where('course_id', '=', $course->id)
						->count();

		$grade_distribution = Comment::get_grade_distribution($course->id, $course->grading_pattern);

		$data = array(
			'title' => $course_code,
			'course' => $course,
			'comments' => $comments,
			'workload_rate' => $workload_rate,
			'total_comment' => $total_comment,
			'grade_distribution' => $grade_distribution,
		);
		return View::make('home.course.detail')->with($data);
	}

	public function post_search()
	{
		$keyword = trim(Input::get('keyword'));
		//dd($keyword);
		if (empty($keyword)) {
			return Redirect::to_route('course')
						->with('alert_type', 'error')
						->with('alert_body', __('app.course_search_empty'));
		} else {
			return Redirect::to('courses/search/' . urlencode($keyword));
		}
	}

	public function get_search($keyword = '')
	{
		$keyword = urldecode(trim($keyword));
		//dd($keyword);
		$data = array(
			'title' => __('app.course_search_result_title', array('keyword' => e($keyword))),
			'courses' => DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->left_join('comments', 'courses.id', '=', 'comments.course_id')
							->where('courses.code', 'LIKE', '%' . $keyword . '%')
							->or_where('courses.title_zh', 'LIKE', '%' . $keyword . '%')
							->or_where('courses.title_en', 'LIKE', '%' . $keyword . '%')
							->group_by('courses.id')
							->order_by('courses.code', 'ASC')
							->paginate(Config::get('app.paginate_per_page')),
			'keyword' => $keyword,
			'search_result' => true,
		);
		return View::make('home.course.index')->with($data);
	}


}