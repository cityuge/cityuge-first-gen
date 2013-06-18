<?php

Event::listen('app.newComment', function($courseId) {
	// Latest comments
	Cache::forget('feed');
	// Latest comments for a course
	Cache::forget('feed_' . $courseId);
	// XML sitemap
	Cache::forget('sitemap');

	// Stats on home page
	Cache::forget('hotCourses_area1');
	Cache::forget('hotCourses_area2');
	Cache::forget('hotCourses_area3');

	Cache::forget('goodGradeCourses_area1');
	Cache::forget('goodGradeCourses_area2');
	Cache::forget('goodGradeCourses_area3');

	Cache::forget('badGradeCourses_area1');
	Cache::forget('badGradeCourses_area2');
	Cache::forget('badGradeCourses_area3');

	Cache::forget('lightWorkloadCourses_area1');
	Cache::forget('lightWorkloadCourses_area2');
	Cache::forget('lightWorkloadCourses_area3');

	Cache::forget('heavyWorkloadCourses_area1');
	Cache::forget('heavyWorkloadCourses_area2');
	Cache::forget('heavyWorkloadCourses_area3');
});