<?php

class CourseController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$courses = DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->leftJoin('comments', function($join) {
								$join->on('courses.id', '=', 'comments.course_id');
								$join->on('comments.deleted_at', null, DB::raw('is null'));
							})
							->groupBy('courses.id')
							->orderBy('courses.code', 'ASC')
							->paginate(Config::get('cityuge.paginate_perPage'));

		$data = array(
			'title' => Lang::choice('app.course', $courses->getCurrentPage(), ['page' => $courses->getCurrentPage()]),
			'courses' => $courses,
			'metaDescription' => Lang::get('app.course_metaDesc'),
		);
		return View::make('home.courses.index')->with($data);
	}

	/**
	 * Display a list of courses in a certain category.
	 *
	 * @return Response
	 */
	public function category($categoryUrl)
	{
		$categoryIndex = array_search($categoryUrl, Course::$categoryUrl);
		// If category is not found, return 404 error
		if ($categoryIndex === false) {
			return App::abort(404);
		}
		$category = Course::$category[$categoryIndex];

		$courses = DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->leftJoin('comments', function($join) {
								$join->on('courses.id', '=', 'comments.course_id');
								$join->on('comments.deleted_at', null, DB::raw('is null'));
							})
							->where('category', '=', $category)
							->groupBy('courses.id')
							->orderBy('courses.code', 'ASC')
							->paginate(Config::get('cityuge.paginate_perPage'));
			
		$data = array(
			'title' => Lang::choice('app.course_categoryTitle', $courses->getCurrentPage(), ['page' => $courses->getCurrentPage(), 'category' => Course::getCategoryTitle($category)]) ,
			'courses' => $courses,
			'metaDescription' => Lang::get('app.course_category_metaDesc', array('category' => Course::getCategoryTitle($category))),
		);
		return View::make('home.courses.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($courseCode)
	{
		$courseCode = strtoupper($courseCode);
		$course = Course::with('department')
						->where('code', '=', $courseCode)
						->first();
		if (!$course) {
			return App::abort(404);
		}

		$comments = Comment::where('course_id', '=', $course->id)
						->orderBy('created_at', 'DESC')
						->paginate(Config::get('cityuge.paginate_commentPerPage'));

		$workloadRate = DB::table('comments')
						->where('course_id', '=', $course->id)
						->where('deleted_at', null, DB::raw('is null'))
						->avg('workload') / 5 * 100;

		$gradeDistribution = Comment::getGradeDistribution($course->id, $course->grading_pattern);

		$data = array(
			'title' => Lang::choice('app.course_detail_title', $comments->getCurrentPage(), array('courseCode' => $courseCode, 'page' => $comments->getCurrentPage())),
			'course' => $course,
			'comments' => $comments,
			'workloadRate' => $workloadRate,
			'totalComment' => $comments->getTotal(),
			'gradeDistribution' => $gradeDistribution,
			'metaKeywords' => array($courseCode, $course->category, $course->department->initial, e($course->department->title_en), e($course->department->title_zh)),
			'metaDescription' => Lang::get('app.course_detail_metaDesc', array('courseCode' => $courseCode, 'courseTitle' => e($course->title_en))),
		);
		return View::make('home.courses.show')->with($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Process the search form.
	 * @return Redirect redirect to the search result page
	 */
	public function search()
	{
		$keyword = trim(Input::get('keyword'));
		if (empty($keyword)) {
			return Redirect::route('courses.index')
						->with('alertType', 'error')
						->with('alertBody', Lang::get('app.course_search_empty'));
		} else {
			return Redirect::route('courses.searchResult', [$keyword]);
		}
	}

	/**
	 * Display the search results.
	 * @param  string $keyword search keyword
	 * @return View            search result view
	 */
	public function searchResult($keyword = '')
	{
		$keyword = urldecode(trim($keyword));

		$results = DB::table('courses')
							->select(array(
								'courses.*',
								'departments.initial',
								'departments.title_en AS department_title_en',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->join('departments', 'courses.department_id', '=', 'departments.id')
							->leftJoin('comments', 'courses.id', '=', 'comments.course_id')
							->where('courses.code', 'LIKE', '%' . $keyword . '%')
							->orWhere('courses.title_zh', 'LIKE', '%' . $keyword . '%')
							->orWhere('courses.title_en', 'LIKE', '%' . $keyword . '%')
							->groupBy('courses.id')
							->orderBy('courses.code', 'ASC')
							->paginate(Config::get('cityuge.paginate_perPage'));

		$data = array(
			'title' => Lang::choice('app.course_search_resultTitle', $results->getCurrentPage(), array('keyword' => e($keyword), 'page' => $results->getCurrentPage())),
			'courses' => $results,
			'keyword' => $keyword,
			'searchResult' => true,
			'metaKeywords' => array(e($keyword)),
			'metaDescription' => Lang::get('app.course_search_metaDesc', array('keyword' => e($keyword))),
		);
		return View::make('home.courses.index')->with($data);
	}

}