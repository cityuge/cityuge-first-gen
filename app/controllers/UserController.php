<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getLogin()
	{
		if (Auth::check()) {
			return Redirect::route('admin.dashboard');
		}
		return View::make('admin.login');
	}

	public function postLogin()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		$remember = Input::get('remember') ? true : false;

		if (Auth::attempt(array('username' => $username, 'password' => $password), $remember)) {
			return Redirect::intended('admin.dashboard')
				->with('alertType', 'success')
				->with('alertBody', trans('app.login_successful'));
		}
		return Redirect::back()->withInput()
				->with('alertType', 'error')
				->with('alertBody', trans('app.login_unsuccessful'));
	}

	public function getLogout()
	{
		if (Auth::check()) {
			Auth::logout();
		}
		return Redirect::route('home');
	}

}