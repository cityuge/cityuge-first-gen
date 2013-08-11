<?php

use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

class FeedController extends \BaseController {

	/**
	 * RSS feed for the site's latest comments.
	 *
	 * @return Response
	 */
	public function siteLatestComments()
	{
		if (!Cache::has('feed')) {
			Cache::forever('feed', $this->prepareSiteLatestCommentsFeed());
		}
		return Response::make(Cache::get('feed'), 200)->header('Content-Type', 'text/xml; charset=utf-8');
	}

	/**
	 * RSS feed for a course's latest comments.
	 *
	 * @return Response
	 */
	public function courseLatestComments($courseCode)
	{
		if (!$course = Course::checkCourseCode($courseCode)) {
			return App::abort(404);
		}

		if (!Cache::has('feed_' . $course->id)) {
			Cache::forever('feed_' . $course->id, $this->prepareCourseLatestCommentsFeed($course));
		}
		return Response::make(Cache::get('feed_' . $course->id), 200)->header('Content-Type', 'text/xml; charset=utf-8');
	}

	private function prepareSiteLatestCommentsFeed() {
		$comments = Comment::with('course')
					->orderBy('created_at', 'DESC')
					->take(Config::get('cityuge.feed_maxItem'))
					->get();

		$feed = new Feed();

		// Channel
		$channel = new Channel();
		$channel->title(Lang::get('app.feed_title'))
				->description(Lang::get('app.feed_description'))
				->url(URL::to(''))
				->pubDate(count($comments) ? $comments[0]->created_at->timestamp : time())
				->ttl(Config::get('cityuge.feed_ttl'))
				->language('zh-hk')
				->copyright('&copy; Swiftzer ' . date('Y'))
				->appendTo($feed);

		// Items
		foreach ($comments as $comment) {
			$url = route('comments.show', array($comment->id));
			$desc = '<dl><dt>' . Lang::get('app.comment_semester') . '</dt><dd>' . e($comment->semester) . '</dd>'
						. '<dt>' . Lang::get('app.comment_instructor') . '</dt><dd>' . e($comment->instructor) . '</dd>'
						. '<dt>' . Lang::get('app.comment_grade') . '</dt><dd>' . e($comment->grade) . '<dd>'
						. '<dt>' . Lang::get('app.comment_workload') . '</dt><dd>' . e($comment->workload) . '</dd></dl>' . $comment->body;

			$item = new Item();
			$item->title($comment->course->code . ' - ' . $comment->course->title_en)
				->description($desc)
				->pubDate($comment->created_at->timestamp)
				->url($url)
				->guid($url, true)
				->appendTo($channel);
		}
		return $feed;
	}

	private function prepareCourseLatestCommentsFeed($course) {
		$comments = Comment::where('course_id', '=', $course->id)
					->orderBy('created_at', 'DESC')
					->take(Config::get('cityuge.feed_maxItem'))
					->get();

		$feed = new Feed();

		// Channel
		$channel = new Channel();
		$channel->title(Lang::get('app.feed_course_title', array('courseCode' => $course->code)))
				->description(Lang::get('app.feed_course_description', array('courseCode' => $course->code)))
				->url(URL::to(''))
				->pubDate(count($comments) ? $comments[0]->created_at->timestamp : time())
				->ttl(Config::get('cityuge.feed_ttl'))
				->language('zh-hk')
				->copyright('&copy; Swiftzer ' . date('Y'))
				->appendTo($feed);

		// Items
		foreach ($comments as $comment) {
			$url = route('comments.show', array($comment->id));
			$desc = '<dl><dt>' . Lang::get('app.comment_semester') . '</dt><dd>' . e($comment->semester) . '</dd>'
						. '<dt>' . Lang::get('app.comment_instructor') . '</dt><dd>' . e($comment->instructor) . '</dd>'
						. '<dt>' . Lang::get('app.comment_grade') . '</dt><dd>' . e($comment->grade) . '<dd>'
						. '<dt>' . Lang::get('app.comment_workload') . '</dt><dd>' . e($comment->workload) . '</dd></dl>' . $comment->body;

			$item = new Item();
			$item->title($course->code . ' - ' . $course->title_en)
				->description($desc)
				->pubDate($comment->created_at->timestamp)
				->url($url)
				->guid($url, true)
				->appendTo($channel);
		}
		return $feed;
	}

}