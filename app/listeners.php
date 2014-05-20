<?php

// Fire when a new comment is posted
Event::listen('app.newComment', function($courseId) {
	// Latest comments
	Cache::forget('feed');
	// XML sitemap
	Cache::forget('sitemap');
	// Stats on home page
	Cache::forget('homeStats');
	// Stats for that course
	Cache::forget('courseStats_' . $courseId);
});

// Fire when a comment is edited
Event::listen('app.editComment', function($courseId) {
	// Latest comments
	Cache::forget('feed');
	// XML sitemap
	Cache::forget('sitemap');
	// Stats on home page
	Cache::forget('homeStats');
	// Stats for that course
	Cache::forget('courseStats_' . $courseId);
});