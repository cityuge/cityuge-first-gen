<?php

class Comment extends BaseModel {
	// Use soft delete for this table
	protected $softDelete = true;

	protected $guarded = array();

	public static $rules = array(
		'semester' => 'required|offering:',  // must append value
		'instructor' => 'required|min:2|max:100',
		'grade' => 'required|in:',  // must append value
		'workload' => 'required|integer|between:1,5',
		'body' => 'required|between:10,3000',
		'recaptcha_response_field' => 'required|recaptcha',
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

	public static function getGradeDistribution($courseId, $gradingPattern) {
		$grades = CourseHelper::getGradingOptionArray($gradingPattern);

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