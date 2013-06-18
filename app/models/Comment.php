<?php

class Comment extends BaseModel {
	protected $guarded = array();

	public static $rules = array(
		'semester' => 'required|in:',			// must append value
		'instructor' => 'required|max:100',
		'grade' => 'required|in:',				// must append value
		'workload' => 'required|integer|between:1,5',
		'body' => 'required',
		'recaptcha_response_field' => 'required|recaptcha',
	);

	protected $softDelete = true;

	public static $semesters = array('2012/13 Sem B', '2012/13 Sem A', '2011/12 Summer', '2011/12 Sem B', '2011/12 Sem A');
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
		return static::$semesterValues[$input];
	}

	public static function getGradeDistribution($courseId, $gradingPattern) {
		$grades = Course::getGradingOptionArray($gradingPattern);

		$query = DB::select('SELECT grade, COUNT(*) AS count FROM comments WHERE course_id = ? GROUP BY grade', array($courseId));

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