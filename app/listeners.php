<?php

// Fire when a new comment is posted
Event::listen('app.newComment', function($courseId) {
	// Latest comments
	Cache::forget('feed');
	// Latest comments for a course
	Cache::forget('feed_' . $courseId);
	// XML sitemap
	Cache::forget('sitemap');
	// Stats on home page
	Cache::forget('homeStats');
});

// Fire when a comment is edited
Event::listen('app.editComment', function($courseId) {
	// Latest comments
	Cache::forget('feed');
	// Latest comments for a course
	Cache::forget('feed_' . $courseId);
	// XML sitemap
	Cache::forget('sitemap');
	// Stats on home page
	Cache::forget('homeStats');
});