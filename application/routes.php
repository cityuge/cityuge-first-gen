<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Course
Route::get('/', array('as' => 'home', 'uses' => 'home@index'));
Route::get('categories/(:any)', array('as' => 'course.category', 'uses' => 'course@category'));
Route::get('courses', array('as' => 'course', 'uses' => 'course@index'));
Route::get('courses/(:any)', array('as' => 'course.detail', 'uses' => 'course@detail'));
Route::get('courses/(:any)/comments/new', array('as' => 'comment.new', 'uses' => 'comment@new'));
Route::post('courses/search', array('before' => 'csrf', 'uses' => 'course@search'));
Route::get('courses/search/(:all)', array('as' => 'course.search_result', 'uses' => 'course@search'));

// Comment
Route::get('comments', array('as' => 'comment', 'uses' => 'comment@index'));
Route::post('comments', array('before' => 'csrf', 'uses' => 'comment@index'));

// Department
Route::get('departments', array('as' => 'department', 'uses' => 'department@index'));
Route::get('departments/(:any)', array('as' => 'department.course', 'uses' => 'department@courses'));

// Misc
Route::get('about', array('as' => 'about', 'uses' => 'home@about'));

// RSS Feed
Route::get('feed', array('as' => 'feed', 'uses' => 'comment@latest_comment_feed'));
Route::get('courses/(:any)/feed', array('as' => 'course.feed', 'uses' => 'comment@latest_course_comment_feed'));

// XML Sitemap
Route::get('sitemap', array('as' => 'sitemap', 'uses' => 'home@sitemap'));

// Sharrre
Route::get('social-media-counter', array('as' => 'sharrre', 'uses' => 'home@social_media_counter'));

/*Route::get('test', function()
{
});*/

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*Event::listen('laravel.query', function($sql, $bindings, $time)
{
	Log::info($sql);
});*/

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});