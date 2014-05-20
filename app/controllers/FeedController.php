<?php

use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

class FeedController extends BaseController {

	/**
	 * RSS feed for the site's latest comments.
	 *
	 * @return Response
	 */
	public function siteLatestComments()
	{
		$that = $this;
		return Cache::rememberForever('feed', function() use ($that) {
			return Response::make($that->prepareSiteLatestCommentsFeed(), 200)->header('Content-Type', 'text/xml; charset=utf-8');
		});
	}

	public function prepareSiteLatestCommentsFeed() {
		$comments = Comment::with('course')
					->orderBy('created_at', 'DESC')
					->take(Config::get('cityuge.feed_maxItem'))
					->get();

		$feed = new Feed();

		// Channel
		$channel = new Channel();
		$channel->title(trans('app.feed_title'))
				->description(trans('app.feed_description'))
				->url(URL::to(''))
				->pubDate(count($comments) ? $comments[0]->created_at->timestamp : time())
				->ttl(Config::get('cityuge.feed_ttl'))
				->language('zh-hk')
				->copyright('&copy; Swiftzer ' . date('Y'))
				->appendTo($feed);

		// Items
		foreach ($comments as $comment) {
			$url = route('comments.show', array($comment->id));
			$desc = '<dl><dt>' . trans('app.comment_semester') . '</dt><dd>' . SemesterHelper::getSemesterText($comment->semester) . '</dd>'
						. '<dt>' . trans('app.comment_instructor') . '</dt><dd>' . e($comment->instructor) . '</dd>'
						. '<dt>' . trans('app.comment_grade') . '</dt><dd>' . e($comment->grade) . '<dd>'
						. '<dt>' . trans('app.comment_workload') . '</dt><dd>' . CommentHelper::getWorkloadText($comment->workload) . '</dd></dl>' . $comment->body;

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
}