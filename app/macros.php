<?php

/**
 * Make the Bootstrap's alert.
 */
HTML::macro('alert', function ($type = null, $message, $dismiss = false, $title = null) {
    switch ($type) {
        case 'success':
            $class = 'alert-success';
            break;
        case 'info':
            $class = 'alert-info';
            break;
        case 'danger':
            $class = 'alert-danger';
            break;
        case 'warning':
            $class = 'alert-warning';
            break;
        default:
            $class = 'alert-warning';
            break;
    }

    $html = "<div class=\"alert {$class}\">";

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
Validator::extend('offering', function ($attribute, $value, $parameters) {
    // Get the offering semesters of that course
    $validSemesters = Offering::where('course_id', '=', $parameters[0])->get(array('semester'))->toArray();
    // Get all the semesters which is allowed for user to input
    $allowedSemesters = SemesterHelper::getSemesterOptions(false);

    return in_array(array('semester' => $value), $validSemesters) && in_array($value, $allowedSemesters);
});

/**
 * Validation rule for reCAPTCHA.
 */
Validator::extend('recaptcha', function ($attribute, $value, $parameters) {
    $secret = Config::get('cityuge.reCaptchaPrivateKey');
    $ip = Request::server('HTTP_CF_CONNECTING_IP') ?
        Request::server('HTTP_CF_CONNECTING_IP') : Request::server('REMOTE_ADDR');

    $ch = curl_init("https://www.google.com/recaptcha/api/siteverify" .
        "?secret={$secret}&response={$value}&remoteip={$ip}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false || $statusCode !== 200) {
        return false;
    }

    $responseJson = json_decode($response);

    return $responseJson->success;
});
