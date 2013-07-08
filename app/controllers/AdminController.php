<?php

class AdminController extends BaseController {

	/**
	 * Dashboard.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.index');
	}

	/**
	 * Purge all the cache manually.
	 * @return Redirect redirect to admin dashboard
	 */
	public function purgeCache()
	{
		Cache::flush();
		return Redirect::route('admin.dashboard')
						->with('alertType', 'success')
						->with('alertBody', Lang::get('app.cache_purged'));
	}

}