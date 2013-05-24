<?php

/**
 * Make the Bootstrap's alert
 * @var [type]
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