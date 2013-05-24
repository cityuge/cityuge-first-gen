<?php

class Department_Controller extends Base_Controller {

	public function get_index()
	{
		$data = array(
			'title' => __('app.department'),
			'departments' => Department::order_by('initial', 'ASC')->get(),
		);
		return View::make('home.department.index')->with($data);
	}

	public function get_courses($initial)
	{
		$initial = strtoupper($initial);
		$department = Department::where('initial', '=', $initial)->first();
		if (!$department) {
			return Response::error('404');
		}
		
		$data = array(
			'title' => $department->title_zh,
			'department' => $department,
			'courses' => DB::table('courses')
							->select(array(
								'courses.*',
								DB::raw('COUNT(comments.id) AS comment_count')))
							->left_join('comments', 'courses.id', '=', 'comments.course_id')
							->where('department_id', '=', $department->id)
							->group_by('courses.id')
							->order_by('courses.code', 'ASC')
							->paginate(Config::get('app.paginate_per_page')),
		);
		return View::make('home.department.course')->with($data);
	}

}