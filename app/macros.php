<?php

/**
 * Make the Bootstrap's alert.
 */
HTML::macro('alert', function($type = null, $message, $dismiss = false, $title = null)
{
	switch ($type) {
		case 'success':
			$class = 'alert-success';
			break;
		case 'info':
			$class = 'alert-info';
			break;
		case 'error':
			$class = 'alert-error';
			break;
		default:
			$class = '';
			break;
	}

	$html = '<div class="alert ' . $class . '">';

	if ($dismiss) {
		$html .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	}

	if ($title) {
		$html .= '<h4>' . $title . '</h4>';
	}

	$html .= $message . '</div>';

	return $html;
});

/**
 * Validation rule for course offering.
 *
 * Provide the course ID in the parameter.
 */
Validator::extend('offering', function($attribute, $value, $parameters)
{
	$validSemesters = Offering::where('course_id', '=', $parameters[0])->get(array('semester'))->toArray();
	return in_array(array('semester' => $value), $validSemesters);
});