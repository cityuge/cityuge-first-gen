<?php

class SemesterHelper {

	/**
	 * Generate the array of semesters using the start and end term configs.
	 * @param  boolean $associativeArray return associative array
	 * @return array                     semesters sorted in descending order
	 */
	public static function getSemesterOptions($associativeArray = true, $end = null) {
		if ($end == null) {
			$end = Config::get('cityuge.currentAllowedSemester');
		}
		$semesters = Config::get('cityuge.semesters');
		
		// End
		$endYearA = substr($end, 0, 2);
		$endYearB = substr($end, 2, 2);
		$endSemester = substr($end, -1);

		$currentYearA = $endYearA;
		$currentYearB = $endYearB;
		$currentSemester = $endSemester;
		$currentSemesterIndex = array_search($currentSemester, $semesters);
		$currentString = $end;

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

	/**
	 * Get the semester string.
	 * @param  string $input semester code used in database
	 * @return string        semester string
	 */
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

	public static function getQuickAccessCategoryLinks($semester) {
		$result = array();
		$categoryCodes = CourseHelper::$category;
		$categoryUrls = CourseHelper::$categoryUrl;
		
		for ($i = 0; $i < count($categoryCodes); $i++) {
			$result[] = array(
				'text' => CourseHelper::getCategoryText($categoryCodes[$i]),
				'url' => route('courses.category', array($categoryUrls[$i], strtolower($semester))),
			);
			
		}
		
		return $result;
	}

}