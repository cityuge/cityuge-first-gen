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

}