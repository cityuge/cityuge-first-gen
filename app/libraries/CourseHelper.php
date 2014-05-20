<?php

class CourseHelper {
	// Course category
	public static $category = array('AREA1', 'AREA2', 'AREA3', 'UNIREQ', 'E');
	public static $categoryUrl = array('area-1', 'area-2', 'area-3', 'university-requirements', 'foundation');

	// Grading
	public static $stdGrading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'F', 'X');
	public static $stdPFGrading = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D', 'P', 'F', 'X');
	public static $pfGrading = array('P', 'F', 'X');

	/**
	 * Get the UI string for category.
	 * @param  string $category category enum
	 * @return string           category in current locale
	 */
	public static function getCategoryText($category) {
		switch ($category) {
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

	/**
	 * Get the course description for Area 1 to 3.
	 * @param  string $category category enum
	 * @return string|null      category description
	 */
	public static function getCategoryDesc($category) {
		switch ($category) {
			case 'AREA1':
				return Lang::get('app.category_desc_area1');
			case 'AREA2':
				return Lang::get('app.category_desc_area2');
			case 'AREA3':
				return Lang::get('app.category_desc_area3');
			default:
				return null;
		}
	}

	/**
	 * Get the standard grade array for the comment form.
	 * @return array standard grades
	 */
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

	/**
	 * Get the standard + pass/fail grade array for the comment form.
	 * @return array standard + pass/fail grades
	 */
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

	/**
	 * Get the pass/fail grade array for the comment form.
	 * @return array pass/fail grades
	 */
	public static function getPfGradingOptions() {
		return array(
			'P' => Lang::get('app.grade_p'),
			'F' => Lang::get('app.grade_f'),
			'X' => Lang::get('app.grade_x'),
		);
	}

	/**
	 * Get the grade locale string.
	 * @param  string input grade in database
	 * @return string grade in current locale
	 */
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

	/**
	 * Get the CSS style suffix for grade
	 * @param  string $prefix CSS style prefix
	 * @param  string $grade  grade in database
	 * @return string         suffix
	 */
	public static function getGradeStyle($prefix, $grade) {
		switch ($grade) {
			case 'A+':
				$suffix = 'ap';
				break;
			case 'A':
				$suffix = 'a';
				break;
			case 'A-':
				$suffix = 'am';
				break;
			case 'B+':
				$suffix = 'bp';
				break;
			case 'B':
				$suffix = 'b';
				break;
			case 'B-':
				$suffix = 'bm';
				break;
			case 'C+':
				$suffix = 'cp';
				break;
			case 'C':
				$suffix = 'c';
				break;
			case 'C-':
				$suffix = 'cm';
				break;
			case 'D':
				$suffix = 'd';
				break;
			case 'X':
				$suffix = 'dropped';
				break;
			case 'P':
				$suffix = 'ap';
				break;
			default:
				$suffix = 'f';
		}
		return $prefix . $suffix;
	}

	/**
	 * Get the grading option array by pattern code
	 * @param  string $gradingPattern grading pattern
	 * @return array                  grade array
	 */
	public static function getGradingOptionArray($gradingPattern) {
		switch ($gradingPattern) {
			case 'PF':
				return static::getPfGradingOptions();
			case 'STD-PF':
				return static::getStdPfGradingOptions();
			default:
				return static::getStdGradingOptions();
		}
	}

	public static function getGradingArray($gradingPattern) {
		switch ($gradingPattern) {
			case 'PF':
				return static::$pfGrading;
			case 'STD-PF':
				return static::$stdPFGrading;
			default:
				return static::$stdGrading;
		}
	}
}