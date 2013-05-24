<?php

/**
 * Forget all the RSS feed cache when there is a new comment posted.
 */
Event::listen('app.new_comment', function($course_id) {
	// Latest comments
	Cache::forget('feed');
	// Latest comments for a course
	Cache::forget('feed_' . $course_id);

	Cache::forget('hot_courses_area1');
	Cache::forget('hot_courses_area2');
	Cache::forget('hot_courses_area3');

	Cache::forget('good_grade_courses_area1');
	Cache::forget('good_grade_courses_area2');
	Cache::forget('good_grade_courses_area3');

	Cache::forget('bad_grade_courses_area1');
	Cache::forget('bad_grade_courses_area2');
	Cache::forget('bad_grade_courses_area3');

	Cache::forget('light_workload_courses_area1');
	Cache::forget('light_workload_courses_area2');
	Cache::forget('light_workload_courses_area3');

	Cache::forget('heavy_workload_courses_area1');
	Cache::forget('heavy_workload_courses_area2');
	Cache::forget('heavy_workload_courses_area3');
});