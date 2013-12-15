<?php

class Course extends BaseModel {
	protected $guarded = array();

	public static $rules = array();

	public $timestamps = false;

	// Course category
	public static $category = array('AREA1', 'AREA2', 'AREA3', 'UNIREQ', 'E');
	public static $categoryUrl = array('area-1', 'area-2', 'area-3', 'university-requirements', 'foundation');

	// Grading
	public static $stdGrading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'F', 'X');
	public static $stdPFGrading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'P', 'F', 'X');
	public static $pfGrading = array('P', 'F', 'X');

	public function department() {
		return $this->belongsTo('Department');
	}

	public function comments() {
		return $this->hasMany('Comment');
	}

	public function offerings() {
		return $this->hasMany('Offering')->orderBy('semester', 'DESC');
	}

	public function getCategoryAttribute($value) {
		return static::getCategoryTitle($value);
	}

	public static function getCategoryTitle($code) {
		switch ($code) {
			case 'AREA1':
				return Lang::get('app.category_area1');
			case 'AREA2':
				return Lang::get('app.category_area2');
			case 'AREA3':
				return Lang::get('app.category_area3');
			case 'UNIREQ':
				return Lang::get('app.category_unireq');
			case 'E':
				return Lang::get('app.category_e');
			default:
				return Lang::get('app.category_misc');
		}
	}

	public static function getStdGradingOptions() {
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
			'F' => Lang::get('app.grade_f'),
			'X' => Lang::get('app.grade_x'),
		);
	}

	public static function getStdPfGradingOptions() {
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
			'P' => Lang::get('app.grade_p'),
			'F' => Lang::get('app.grade_f'),
			'X' => Lang::get('app.grade_x'),
		);
	}

	public static function getPfGradingOptions() {
		return array(
			'P' => Lang::get('app.grade_p'),
			'F' => Lang::get('app.grade_f'),
			'X' => Lang::get('app.grade_x'),
		);
	}

	public static function getGradeText($input) {
		if ($input === 'P') {
			return Lang::get('app.grade_p');
		} else if ($input === 'F') {
			return Lang::get('app.grade_f');
		} else if ($input === 'X') {
			return Lang::get('app.grade_x');
		} else {
			return $input;
		}
	}

	public static function getRawGradeByText($input) {
		switch ($input) {
			case Lang::get('app.grade_p'):
				return 'P';
			case Lang::get('app.grade_f'):
				return 'F';
			case Lang::get('app.grade_x'):
				return 'X';
			default:
				return $input;
		}
	}

	public static function getGradingOptionArray($gradingPattern) {
		if ($gradingPattern === 'PF') {
			return Course::getPfGradingOptions();
		} else if ($gradingPattern === 'STD-PF') {
			return Course::getStdPfGradingOptions();
		} else {
			return Course::getStdGradingOptions();
		}
	}

	public static function checkCourseCode($courseCode) {
		$courseCode = strtoupper($courseCode);
		$course = Course::where('code', '=', $courseCode)->first();
		if ($course) {
			return $course;
		}
		return false;
	}

	public static function getGradeStyle($grade) {
		$gradeStyle = array(
			'A+' => 'ap',
			'A' => 'a',
			'A-' => 'am',
			'B+' => 'bp',
			'B' => 'b',
			'B-' => 'bm',
			'C+' => 'cp',
			'C' => 'c',
			'C-' => 'cm',
			'D' => 'd',
			'Fail' => 'f',
			'Dropped' => 'dropped',
			'Pass' => 'ap',
			);
		return $gradeStyle[$grade];
	}

	public static function getSearchTypeaheadList() {
		if (!Cache::has('courseTypeahead')) {
			$courses = static::orderBy('code', 'ASC')->get(array('title_en', 'category', 'code'))->toArray();
			$list = array();
			foreach ($courses as $course) {
				$list[] = array(
					'title' => $course['title_en'],
					'category' => $course['category'],
					'value' => $course['code'],
					'tokens' => array(
						$course['code'],
						preg_replace("/[A-Z]/", "", $course['code']),
						$course['title_en'],
					),
				);
			}
			// Save the queries in cache
			Cache::forever('courseTypeahead', json_encode($list));
		}
		return Cache::get('courseTypeahead');
	}

	public static function getHomeStats() {
		if (!Cache::has('homeStats')) {
			$stats = array(
				'hotCoursesArea1' => static::getHotCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'hotCoursesArea2' => static::getHotCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'hotCoursesArea3' => static::getHotCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'goodGradeCoursesArea1' => static::getGoodGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'goodGradeCoursesArea2' => static::getGoodGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'goodGradeCoursesArea3' => static::getGoodGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'badGradeCoursesArea1' => static::getBadGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'badGradeCoursesArea2' => static::getBadGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'badGradeCoursesArea3' => static::getBadGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'lightWorkloadCoursesArea1' => static::getLightWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'lightWorkloadCoursesArea2' => static::getLightWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'lightWorkloadCoursesArea3' => static::getLightWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'heavyWorkloadCoursesArea1' => static::getHeavyWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'heavyWorkloadCoursesArea2' => static::getHeavyWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'heavyWorkloadCoursesArea3' => static::getHeavyWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),
			);
			// Save the queries in cache
			Cache::forever('homeStats', $stats);
		}
		return Cache::get('homeStats');
	}

	/**
	 * Get the courses which have most comments.
	 * @param  string $category category like AREA1, AREA2...
	 * @param  int    $limit    max number of courses return
	 * @return array            list of courses
	 */
	public static function getHotCourses($category, $limit) {
		$query = DB::select('SELECT courses.code, courses.title_en FROM courses '
					. 'INNER JOIN comments ON comments.course_id = courses.id '
					. 'WHERE courses.category = ? '
					. 'GROUP BY courses.id '
					. 'ORDER BY COUNT(*) DESC '
					. 'LIMIT ?',
					array($category, $limit));
		return $query;
	}

	public static function getGoodGradeCourses($category, $limit) {
		$query = DB::select('SELECT * FROM (SELECT courses.code, courses.title_en, '
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
						. ') AS t WHERE gpa IS NOT NULL AND gpa >= 3.3 LIMIT ?',
					array($category, $limit));
		return $query;
	}

	public static function getBadGradeCourses($category, $limit) {
		$query = DB::select('SELECT * FROM (SELECT courses.code, courses.title_en, '
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
						. 'INNER JOIN comments on comments.course_id = courses.id AND comments.deleted_at IS NULL '
						. 'WHERE courses.category = ? '
						. 'GROUP BY courses.id '
						. 'ORDER BY gpa ASC'
						. ') AS t WHERE gpa IS NOT NULL AND gpa < 2.7 LIMIT ?',
					array($category, $limit));
		return $query;
	}

	public static function getLightWorkloadCourses($category, $limit) {
		$query = DB::select('SELECT courses.code, courses.title_en FROM courses '
					. 'INNER JOIN comments ON courses.id = comments.course_id AND comments.deleted_at IS NULL '
					. 'WHERE courses.category = ? '
					. 'GROUP BY courses.id '
					. 'HAVING AVG(comments.workload) <= 2 '
					. 'ORDER BY AVG(comments.workload) ASC '
					. 'LIMIT ?',
					array($category, $limit));
		return $query;
	}

	public static function getHeavyWorkloadCourses($category, $limit) {
		$query = DB::select('SELECT courses.code, courses.title_en FROM courses '
					. 'INNER JOIN comments ON courses.id = comments.course_id AND comments.deleted_at IS NULL '
					. 'WHERE courses.category = ? '
					. 'GROUP BY courses.id '
					. 'HAVING AVG(comments.workload) >= 4 '
					. 'ORDER BY AVG(comments.workload) DESC '
					. 'LIMIT ?',
					array($category, $limit));
		return $query;
	}
}