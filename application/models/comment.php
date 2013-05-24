<?php

class Comment extends Basemodel 
{
	public static $rules = array(
		//'course_id' => 'required|exists:courses,id',
		'semester' => 'required|in:',			// must append value
		'instructor' => 'required|max:100',
		'grade' => 'required|in:',				// must append value
		'workload' => 'required|integer|between:1,5',
		'comment' => 'required',
		'recaptcha_response_field' => 'required|recaptcha:***REMOVED***',
	);

	public static $semesters = array('2012/13 Sem A', '2011/12 Summer', '2011/12 Sem B', '2011/12 Sem A');
	public static $semester_values = array(
		'1213A' => '2012/13 Sem A',
		'1112S' => '2011/12 Summer',
		'1112B' => '2011/12 Sem B',
		'1112A' => '2011/12 Sem A',
	);

	public function course() {
		return $this->belongs_to('Course');
	}

	public function set_instructor($val) {
		$this->set_attribute('instructor', trim($val));
	}

	public function set_comment($val) {
		$result = trim($val);
		$result = e($result);
		$result = nl2br($result, true);
		$result = '<p>' . preg_replace('/(<br\s?\/>(\n|\r\n|\r)*){2,}/m', '</p><p>', $result) . '</p>';
		$this->set_attribute('comment', trim($result));
	}

	public static function get_workload_options() {
		return array(
			'1' => Lang::line('app.workload_1')->get(),
			'2' => Lang::line('app.workload_2')->get(),
			'3' => Lang::line('app.workload_3')->get(),
			'4' => Lang::line('app.workload_4')->get(),
			'5' => Lang::line('app.workload_5')->get(),
		);
	}

	public static function get_workload_text($index) {
		$workloads = self::get_workload_options();
		return $workloads[$index];
	}

	public static function get_semester_text($input) {
		return static::$semester_values[$input];
	}

	public static function get_grade_distribution($course_id, $grading_pattern) {
		$grades = Course::get_grading_option_array($grading_pattern);

		$query = DB::query('SELECT grade, COUNT(*) AS count FROM comments WHERE course_id = ? GROUP BY grade', array($course_id));

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