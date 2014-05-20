<?php

class Course extends BaseModel {
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function department() {
		return $this->belongsTo('Department');
	}

	public function comments() {
		return $this->hasMany('Comment');
	}

	public function offerings() {
		return $this->hasMany('Offering')->orderBy('semester', 'DESC');
	}	

	public static function checkCourseCode($courseCode) {
		$courseCode = strtoupper($courseCode);
		$course = static::where('code', '=', $courseCode)->first();
		if ($course) {
			return $course;
		}
		return false;
	}

	/**
	 * Get the statistics of a course.
	 * @param  Course  $course course object
	 * @return array           associative array with workload rate and grade distribution
	 */
	public static function getCourseStats(Course $course) {
		return Cache::rememberForever('courseStats_' . $course->id, function() use ($course) {
			$workloadRate = DB::table('comments')
					->where('course_id', '=', $course->id)
					->where('deleted_at', null, DB::raw('IS NULL'))
					->avg('workload') / 5 * 100;
			$gradeDistribution = Comment::getGradeDistribution($course->id, $course->grading_pattern);
			return array(
				'workloadRate' => $workloadRate,
				'gradeDistribution' => $gradeDistribution,
			);
		});
	}

	/**
	 * Get the JSON for course search typeahead.
	 * @return string course list
	 */
	public static function getSearchTypeaheadList() {
		$self = __CLASS__;
		return Cache::rememberForever('courseTypeahead', function() use ($self) {
			$courses = $self::orderBy('code', 'ASC')->get(array('title_en', 'category', 'code'))->toArray();
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
			return json_encode($list);
		});
	}

	/**
	 * Get statistics from database.
	 * @return array statistics
	 */
	public static function getHomeStats() {
		$self = __CLASS__;
		return Cache::rememberForever('homeStats', function() use ($self) {
			return array(
				'hotCoursesArea1' => $self::getHotCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'hotCoursesArea2' => $self::getHotCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'hotCoursesArea3' => $self::getHotCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'goodGradeCoursesArea1' => $self::getGoodGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'goodGradeCoursesArea2' => $self::getGoodGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'goodGradeCoursesArea3' => $self::getGoodGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'badGradeCoursesArea1' => $self::getBadGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'badGradeCoursesArea2' => $self::getBadGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'badGradeCoursesArea3' => $self::getBadGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'lightWorkloadCoursesArea1' => $self::getLightWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'lightWorkloadCoursesArea2' => $self::getLightWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'lightWorkloadCoursesArea3' => $self::getLightWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

				'heavyWorkloadCoursesArea1' => $self::getHeavyWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
				'heavyWorkloadCoursesArea2' => $self::getHeavyWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
				'heavyWorkloadCoursesArea3' => $self::getHeavyWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),
			);
		});
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