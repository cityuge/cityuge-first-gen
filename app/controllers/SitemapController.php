<?php

use \Sitemap\Sitemap\SitemapEntry;
use \Sitemap\Collection;
use \Sitemap\Formatter\XML\URLSet;

class SitemapController extends BaseController {

	/**
	 * Sitemap for the site.
	 *
	 * @return Response
	 */
	public function index()
	{
		

		if (!Cache::has('sitemap')) {
			Cache::forever('sitemap', $this->prepareSitemap());
		}
		return Response::make(Cache::get('sitemap'), 200)->header('Content-Type', 'text/xml; charset=utf-8');
	}

	private function prepareSitemap()
	{
		$collection = new Collection;
		$collection->setFormatter(new URLSet);

		// Static pages
		// Home, use the current time as the sitemap is cached
		$entry = new SitemapEntry;
		$entry->setLocation(URL::to(''));
		$entry->setLastMod(date('c'));
		$entry->setChangeFreq('hourly');
		$entry->setPriority('1.0');
		$collection->addSitemap($entry);
		// About, use the view file's last modified date
		$entry = new SitemapEntry;
		$entry->setLocation(URL::route('about'));
		$entry->setLastMod(date('c', File::lastModified(__DIR__ . '/../views/home/about.blade.php')));
		$entry->setChangeFreq('monthly');
		$entry->setPriority('0.5');
		$collection->addSitemap($entry);
		// Comment
		$entry = new SitemapEntry;
		$entry->setLocation(URL::route('comments.index'));
		$entry->setLastMod(date('c', time(DB::selectOne('SELECT created_at FROM comments ORDER BY updated_at DESC LIMIT 1')->created_at)));
		$entry->setChangeFreq('hourly');
		$entry->setPriority('0.6');
		$collection->addSitemap($entry);
		// Course
		$courses = DB::select('SELECT courses.code, comments.created_at FROM courses '
							. 'LEFT JOIN comments ON comments.course_id = courses.id '
							. 'AND comments.id IN (SELECT MAX(id) FROM comments GROUP BY comments.course_id)');
		foreach ($courses as $course) {
			// If created_at is NULL, then use the view file's last modified date
			$time = $course->created_at ? date('c', time($course->created_at)) : date('c', File::lastModified(__DIR__ . '/../views/home/courses/show.blade.php'));

			$entry = new SitemapEntry;
			$entry->setLocation(URL::route('courses.show', array(strtolower($course->code))));
			$entry->setLastMod($time);
			$entry->setChangeFreq('daily');
			$entry->setPriority('0.7');
			$collection->addSitemap($entry);
		}
		return $collection->output();
	}

}