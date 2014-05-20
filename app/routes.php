<?php

/*
|--------------------------------------------------------------------------
| Application Locale Handling
|--------------------------------------------------------------------------
|
| Check the locale code is in the URL and set the application locale if
| exist. A route group will wrap all the routes which insert the locale
| code in the URL.
| 
| Reference: http://forums.laravel.io/viewtopic.php?id=7458
|
*/

// the first segment of the URL is for the locale
$locale = Request::segment(1);
$localeIndex = array_search($locale, Config::get('cityuge.availableLocaleURL'));

$availableLocales = Config::get('cityuge.availableLocale');
$availableLocaleISOs = Config::get('cityuge.availableLocaleISO');
if ($localeIndex !== false && $localeIndex !== 0) {
	// locale is in the available locale list but not the default one
	App::setLocale($availableLocales[$localeIndex]);
	Session::put('_locale', $availableLocales[$localeIndex]);
	Session::put('_localeISO', $availableLocaleISOs[$localeIndex]);
} else {
	// locale is invalid or the default one
	$locale = null;
	Session::put('_locale', $availableLocales[0]);
	Session::put('_localeISO', $availableLocaleISOs[0]);
}


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Language route group
Route::group(array('prefix' => $locale), function() {

	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
	Route::get('about', array('as' => 'about', 'uses' => 'HomeController@about'));
	Route::get('statistics', array('as' => 'stats', 'uses' => 'HomeController@stats'));

	// Department
	Route::get('departments', array('as' => 'departments.index', 'uses' => 'DepartmentController@index'));
	Route::get('departments/{initial}', array('as' => 'departments.courses', 'uses' => 'DepartmentController@courses'));

	// Course
	Route::get('courses', array('as' => 'courses.index', 'uses' => 'CourseController@index'));
	Route::get('courses/categories/{category}/{semester?}', array('as' => 'courses.category', 'uses' => 'CourseController@category'));
	Route::get('courses/{code}', array('as' => 'courses.show', 'uses' => 'CourseController@show'));
	Route::get('courses/{code}/comments/create', array('as' => 'comments.create', 'uses' => 'CommentController@create'));

	// Search
	Route::get('search', array('as' => 'courses.search', 'uses' => 'CourseController@search'));
	Route::post('search', array('as' => 'courses.processSearch', 'uses' => 'CourseController@processSearch'));
	Route::get('search/results', array('as' => 'courses.searchResult', 'uses' => 'CourseController@searchResult'));

	// Comment
	Route::get('comments', array('as' => 'comments.index', 'uses' => 'CommentController@index'));
	Route::get('comments/{id}', array('as' => 'comments.show', 'uses' => 'CommentController@show'))->where('id', '[0-9]+');
	Route::post('comments', array('as' => 'comments.store', 'uses' => 'CommentController@store'));

	// Admin
	Route::get('login', array('as' => 'login', 'uses' => 'UserController@getLogin'));
	Route::group(array('before' => 'auth', 'prefix' => 'admin'), function() {
		Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'AdminController@index'));
		Route::post('purge-cache', array('as' => 'admin.cache.purge', 'uses' => 'AdminController@purgeCache', 'before' => 'csrf'));
	});

});

// Login and logout actions
Route::post('login', array('as' => 'loggingIn', 'before' => 'csrf', 'uses' => 'UserController@postLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@getLogout'));

// RSS feed
Route::get('feed', array('as' => 'feed', 'uses' => 'FeedController@siteLatestComments'));

// Sitemap
Route::get('sitemap', array('as' => 'sitemap', 'uses' => 'SitemapController@index'));

// Web API
Route::group(array('prefix' => 'web-api'), function() {
	Route::get('courses/typeahead', array('uses' => 'CourseController@courseListTypeahead'));
});