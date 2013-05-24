<?php

class Course extends Basemodel 
{
	public static $timestamps = false;

	public static $category = array('AREA1', 'AREA2', 'AREA3', 'UNIREQ', 'E');
	public static $category_url = array('area-1', 'area-2', 'area-3', 'university-requirements', 'foundation');

	public static $std_grading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'F', 'X');
	public static $std_pf_grading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'P', 'F', 'X');
	public static $pf_grading = array('P', 'F', 'X');

	public function department() {
		return $this->belongs_to('Department');
	}

	public function comments() {
		return $this->has_many('Comment');
	}

	public static function get_category_title($code) {
		if ($code === 'AREA1') {
			return Lang::line('app.category_area1')->get();
		} else if ($code === 'AREA2') {
			return Lang::line('app.category_area2')->get();
		} else if ($code === 'AREA3') {
			return Lang::line('app.category_area3')->get();
		} else if ($code === 'UNIREQ') {
			return Lang::line('app.category_unireq')->get();
		} else if ($code === 'E') {
			return Lang::line('app.category_e')->get();
		} else {
			return Lang::line('app.category_misc')->get();
		}
	}

	public static function get_std_grading_options() {
		return array(
			'A+' => 'A+',
			'A' => 'A',
			'A-' => 'A-',
			'B+' => 'B+',
			'B' => 'B',
			'B-' => 'B-',
			'C+' => 'C+',
			'C' => 'C',
			'C-' => 'C-',
			'D' => 'D',
			'F' => Lang::line('app.grade_f')->get(),
			'X' => Lang::line('app.grade_x')->get(),
		);
	}

	public static function get_std_pf_grading_options() {
		return array(
			'A+' => 'A+',
			'A' => 'A',
			'A-' => 'A-',
			'B+' => 'B+',
			'B' => 'B',
			'B-' => 'B-',
			'C+' => 'C+',
			'C' => 'C',
			'C-' => 'C-',
			'D' => 'D',
			'P' => Lang::line('app.grade_p')->get(),
			'F' => Lang::line('app.grade_f')->get(),
			'X' => Lang::line('app.grade_x')->get(),
		);
	}

	public static function get_pf_grading_options() {
		return array(
			'P' => Lang::line('app.grade_p')->get(),
			'F' => Lang::line('app.grade_f')->get(),
			'X' => Lang::line('app.grade_x')->get(),
		);
	}

	public static function get_grade_text($input) {
		if ($input === 'P') {
			return Lang::line('app.grade_p')->get();
		} else if ($input === 'F') {
			return Lang::line('app.grade_f')->get();
		} else if ($input === 'X') {
			return Lang::line('app.grade_x')->get();
		} else {
			return $input;
		}
	}

	public static function get_grading_option_array($grading_pattern) {
		if ($grading_pattern === 'PF') {
			return Course::get_pf_grading_options();
		} else if ($grading_pattern === 'STD-PF') {
			return Course::get_std_pf_grading_options();
		} else {
			return Course::get_std_grading_options();
		}
	}

	public static function check_course_code($course_code) {
		$course_code = strtoupper($course_code);
		$course = Course::where('code', '=', $course_code)->first();
		if ($course) {
			return $course;
		}
		return false;
	}

	public static function get_hot_courses($category, $limit) {
		$cache_name = 'hot_courses_' . strtolower($category);

		if (!Cache::has($cache_name)) {
			$query = DB::query('SELECT courses.code, courses.title_en FROM courses '
						. 'INNER JOIN comments ON comments.course_id = courses.id '
						. 'WHERE courses.category = ? '
						. 'GROUP BY courses.id '
						. 'ORDER BY COUNT(*) DESC '
						. 'LIMIT ?',
						array($category, $limit));
			Cache::forever($cache_name, $query);
			return $query;
		}

		return Cache::get($cache_name);
	}

	public static function get_good_grade_courses($category, $limit) {
		$cache_name = 'good_grade_courses_' . strtolower($category);

		if (!Cache::has($cache_name)) {
			$query = DB::query('SELECT * FROM (SELECT courses.code, courses.title_en, '
							. 'AVG(CASE comments.grade '
							. "WHEN 'A+' THEN 4.3 "
							. "WHEN 'A' THEN 4 "
							. "WHEN 'A-' THEN 3.7 "
							. "WHEN 'B+' THEN 3.3 "
							. "WHEN 'B' THEN 3 "
							. "WHEN 'B-' THEN 2.7 "
							. "WHEN 'C+' THEN 2.3 "
							. "WHEN 'C' THEN 2 "
							. "WHEN 'C-' THEN 1.7 "
							. "WHEN 'D' THEN 1 "
							. "WHEN 'F' THEN 0 "
							. 'ELSE NULL END) AS gpa '
							. 'FROM courses '
							. 'INNER JOIN comments on comments.course_id = courses.id '
							. 'WHERE courses.category = ? '
							. 'GROUP BY courses.id '
							. 'ORDER BY gpa DESC'
							. ') AS t WHERE gpa IS NOT NULL AND gpa >= 2.7 LIMIT ?',
						array($category, $limit));
			Cache::forever($cache_name, $query);
			return $query;
		}

		return Cache::get($cache_name);
	}

	public static function get_bad_grade_courses($category, $limit) {
		$cache_name = 'bad_grade_courses_' . strtolower($category);

		if (!Cache::has($cache_name)) {
			$query = DB::query('SELECT * FROM (SELECT courses.code, courses.title_en, '
							. 'AVG(CASE comments.grade '
							. "WHEN 'A+' THEN 4.3 "
							. "WHEN 'A' THEN 4 "
							. "WHEN 'A-' THEN 3.7 "
							. "WHEN 'B+' THEN 3.3 "
							. "WHEN 'B' THEN 3 "
							. "WHEN 'B-' THEN 2.7 "
							. "WHEN 'C+' THEN 2.3 "
							. "WHEN 'C' THEN 2 "
							. "WHEN 'C-' THEN 1.7 "
							. "WHEN 'D' THEN 1 "
							. "WHEN 'F' THEN 0 "
							. 'ELSE NULL END) AS gpa '
							. 'FROM courses '
							. 'INNER JOIN comments on comments.course_id = courses.id '
							. 'WHERE courses.category = ? '
							. 'GROUP BY courses.id '
							. 'ORDER BY gpa ASC'
							. ') AS t WHERE gpa IS NOT NULL AND gpa < 2.7 LIMIT ?',
						array($category, $limit));
			Cache::forever($cache_name, $query);
			return $query;
		}

		return Cache::get($cache_name);
	}

	public static function get_light_workload_courses($category, $limit) {
		$cache_name = 'light_workload_courses_' . strtolower($category);

		if (!Cache::has($cache_name)) {
			$query = DB::query('SELECT courses.code, courses.title_en FROM courses '
						. 'INNER JOIN comments ON courses.id = comments.course_id '
						. 'WHERE courses.category = ? '
						. 'GROUP BY courses.id '
						. 'HAVING AVG(comments.workload) <= 2 '
						. 'ORDER BY AVG(comments.workload) ASC '
						. 'LIMIT ?',
						array($category, $limit));
			Cache::forever($cache_name, $query);
			return $query;
		}

		return Cache::get($cache_name);
	}

	public static function get_heavy_workload_courses($category, $limit) {
		$cache_name = 'heavy_workload_courses_' . strtolower($category);

		if (!Cache::has($cache_name)) {
			$query = DB::query('SELECT courses.code, courses.title_en FROM courses '
						. 'INNER JOIN comments ON courses.id = comments.course_id '
						. 'WHERE courses.category = ? '
						. 'GROUP BY courses.id '
						. 'HAVING AVG(comments.workload) >= 4 '
						. 'ORDER BY AVG(comments.workload) DESC '
						. 'LIMIT ?',
						array($category, $limit));
			Cache::forever($cache_name, $query);
			return $query;
		}

		return Cache::get($cache_name);
	}
}