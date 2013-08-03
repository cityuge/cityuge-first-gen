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

if ($localeIndex !== false && $localeIndex !== 0) {
	// locale is in the available locale list but not the default one
	App::setLocale(Config::get('cityuge.availableLocale')[$localeIndex]);
	Session::put('_locale', Config::get('cityuge.availableLocale')[$localeIndex]);
	Session::put('_localeISO', Config::get('cityuge.availableLocaleISO')[$localeIndex]);
} else {
	// locale is invalid or the default one
	$locale = null;
	Session::put('_locale', Config::get('cityuge.availableLocale')[0]);
	Session::put('_localeISO', Config::get('cityuge.availableLocaleISO')[0]);
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

	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::get('about', ['as' => 'about', 'uses' => 'HomeController@about']);

	// Department
	Route::get('departments', ['as' => 'departments.index', 'uses' => 'DepartmentController@index']);
	Route::get('departments/{initial}', ['as' => 'departments.courses', 'uses' => 'DepartmentController@courses']);

	// Course
	Route::get('courses', ['as' => 'courses.index', 'uses' => 'CourseController@index']);
	Route::get('courses.json', ['uses' => 'CourseController@courseListTypeahead']);
	Route::get('courses/categories/{category}/{semester?}', ['as' => 'courses.category', 'uses' => 'CourseController@category']);
	Route::get('courses/{code}', ['as' => 'courses.show', 'uses' => 'CourseController@show']);
	Route::get('courses/{code}/comments/create', array('as' => 'comments.create', 'uses' => 'CommentController@create'));

	// Search
	Route::get('search', array('as' => 'courses.search', 'uses' => 'CourseController@search'));
	Route::post('search', array('as' => 'courses.processSearch', 'uses' => 'CourseController@processSearch'));
	Route::get('search/{keyword}', array('as' => 'courses.searchResult', 'uses' => 'CourseController@searchResult'));
	// Redirect all the new comment links to the new url (for SEO)
	Route::get('courses/{code}/comments/new', function($code) {
		return Redirect::route('comments.create', array($code), 301);
	});

	// Comment
	Route::get('comments', ['as' => 'comments.index', 'uses' => 'CommentController@index']);
	Route::get('comments/{id}', ['as' => 'comments.show', 'uses' => 'CommentController@show'])->where('id', '[0-9]+');
	Route::post('comments', ['as' => 'comments.store', 'uses' => 'CommentController@store']);

	// Admin
	Route::get('login', ['as' => 'login', 'uses' => 'UserController@getLogin']);
	Route::group(array('before' => 'auth', 'prefix' => 'admin'), function() {
		Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
		Route::post('purge-cache', ['as' => 'admin.cache.purge', 'uses' => 'AdminController@purgeCache', 'before' => 'csrf']);
	});

});

// Login and logout actions
Route::post('login', ['as' => 'loggingIn', 'before' => 'csrf', 'uses' => 'UserController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@getLogout']);

// RSS feed
Route::get('feed', ['as' => 'feed', 'uses' => 'FeedController@siteLatestComments']);
Route::get('courses/{code}/feed', ['as' => 'courses.feed', 'uses' => 'FeedController@courseLatestComments']);

// Sitemap
Route::get('sitemap', ['as' => 'sitemap', 'uses' => 'SitemapController@index']);

// Sharrre
Route::get('social-media-counter', array('as' => 'sharrre', 'uses' => 'HomeController@socialMediaCounter'));