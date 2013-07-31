<?php

class Comment extends BaseModel {
	// Use soft delete for this table
	protected $softDelete = true;

	protected $guarded = array();

	public static $rules = array(
		'semester' => 'required|offering:',			// must append value
		'instructor' => 'required|max:100',
		'grade' => 'required|in:',				// must append value
		'workload' => 'required|integer|between:1,5',
		'body' => 'required|min:20',
		'recaptcha_response_field' => 'required|recaptcha',
	);

	public static $semesterValues = array(
		'1213B' => '2012/13 Sem B',
		'1213A' => '2012/13 Sem A',
		'1112S' => '2011/12 Summer',
		'1112B' => '2011/12 Sem B',
		'1112A' => '2011/12 Sem A',
	);

	public function course() {
		return $this->belongsTo('Course');
	}

	public function setBodyAttribute($val) {
		$result = trim($val);
		$result = e($result);
		$result = nl2br($result, true);
		$result = '<p>' . preg_replace('/(<br\s?\/>(\n|\r\n|\r)*){2,}/m', '</p><p>', $result) . '</p>';
		$this->attributes['body'] = trim($result);
	}

	public function setAdminNoteAttribute($val) {
		$result = trim($val);
		$result = e($result);
		$result = nl2br($result, true);
		$result = '<p>' . preg_replace('/(<br\s?\/>(\n|\r\n|\r)*){2,}/m', '</p><p>', $result) . '</p>';
		$this->attributes['admin_note'] = trim($result);
	}

	public function getSemesterAttribute($val) {
		return static::getSemesterText($val);
	}

	public function getGradeAttribute($val) {
		return Course::getGradeText($val);
	}

	public function getWorkloadAttribute($val) {
		return static::getWorkloadText($val);
	}

	/**
	 * Generate the array of semesters using the start and end term configs.
	 * @param  boolean $associativeArray return associative array
	 * @return array                     semesters sorted in descending order
	 */
	public static function getSemesterOptions($associativeArray = true) {
		$semesters = Config::get('cityuge.semesters');
		
		// End
		$endYearA = substr(Config::get('cityuge.currentAllowedSemester'), 0, 2);
		$endYearB = substr(Config::get('cityuge.currentAllowedSemester'), 2, 2);
		$endSemester = substr(Config::get('cityuge.currentAllowedSemester'), -1);

		$currentYearA = $endYearA;
		$currentYearB = $endYearB;
		$currentSemester = $endSemester;
		$currentSemesterIndex = array_search($currentSemester, $semesters);
		$currentString = Config::get('cityuge.currentAllowedSemester');

		// Create the array
		$result = array();
		// Insert the first item (end term)
		if ($associativeArray) {
			$result[$currentString] = static::getSemesterText($currentString);
		} else {
			$result[] = $currentString;
		}
		while ($currentString !== Config::get('cityuge.firstAllowedSemester')) {
			if ($currentSemesterIndex > 0) {
				$currentSemesterIndex--;
			} else {
				// need to change years and reset the semester counter
				$currentSemesterIndex = count($semesters) - 1;
				$currentYearA = (int) $currentYearA;
				$currentYearA--;
				$currentYearB = (int) $currentYearB;
				$currentYearB--;
				$currentYearA = sprintf('%02d', $currentYearA--);
				$currentYearB = sprintf('%02d', $currentYearB--);
			}
			$currentSemester = $semesters[$currentSemesterIndex];
			$currentString = $currentYearA . $currentYearB . $currentSemester;
			if ($associativeArray) {
				$result[$currentString] = static::getSemesterText($currentString);
			} else {
				$result[] = $currentString;
			}
		}
		return $result;
	}

	public static function getWorkloadOptions() {
		return array(
			'1' => Lang::get('app.workload_1'),
			'2' => Lang::get('app.workload_2'),
			'3' => Lang::get('app.workload_3'),
			'4' => Lang::get('app.workload_4'),
			'5' => Lang::get('app.workload_5'),
		);
	}

	public static function getWorkloadText($index) {
		$workloads = self::getWorkloadOptions();
		return $workloads[$index];
	}

	public static function getSemesterText($input) {
		$startYear = substr($input, 0, 2);
		$endYear = substr($input, 2, 2);
		switch (substr($input, -1)) {
			case 'A':
				$semester = 'Sem A';
				break;
			case 'B':
				$semester = 'Sem B';
				break;
			default:
				$semester = 'Summer';
		}
		return sprintf('20%s/%s %s', $startYear, $endYear, $semester);
	}

	public static function getGradeDistribution($courseId, $gradingPattern) {
		$grades = Course::getGradingOptionArray($gradingPattern);

		$query = DB::select('SELECT grade, COUNT(*) AS count FROM comments WHERE course_id = ? AND deleted_at IS NULL GROUP BY grade', array($courseId));

		$distrubution = array();
		foreach ($grades as $key => $value) {
			$distrubution[$value] = 0;
			foreach ($query as $row) {
				if ($row->grade === $key) {
					$distrubution[$value] = $row->count;
					break;
				}
			}
		}
		return $distrubution;
	}

}