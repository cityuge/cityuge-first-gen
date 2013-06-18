<?php

class DepartmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array(
			'title' => Lang::get('app.department'),
			'departments' => Department::orderBy('initial', 'ASC')->get(),
			'metaKeywords' => array('學系', '學院', '學部', '學術部門', '支援部門', 'department', 'colleage', 'school', 'faculty', 'division'),
			'metaDescription' => Lang::get('app.department_metaDesc'),
		);
		return View::make('home.departments.index')->with($data);
	}

	public function courses($initial)
	{
		$initial = strtoupper($initial);
		$department = Department::where('initial', '=', $initial)->first();
		// If no department is found in database, return 404 error
		if (!$department) {
			return App::abort(404);
		}
		
		$data = array(
			'title' => $department->title_zh,
			'department' => $department,
			'courses' => DB::table('courses')
							->select(array(
								'courses.*',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->leftJoin('comments', 'courses.id', '=', 'comments.course_id')
							->where('department_id', '=', $department->id)
							->groupBy('courses.id')
							->orderBy('courses.code', 'ASC')
							->paginate(Config::get('cityuge.paginate_perPage')),
			'metaKeywords' => array($department->initial, e($department->title_en), e($department->title_zh)),
			'metaDescription' => Lang::get('app.department_courseMetaDesc', array('department' => e($department->title_zh))),
		);
		return View::make('home.departments.courses')->with($data);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

}