<?php

return array(
	// App version shown in footer
	'version' => '1.0.0',

	// Locale
	'availableLocale' => array('zh-hk', 'zh-cn', 'en'),
	'availableLocaleURL' => array('hk', 'cn', 'en'),
	'availableLocaleISO' => array('zh-HK', 'zh-CN', 'en'),

	// Latest semester which allowed to use when posting a comment
	'currentAllowedSemester' => '1314B',
	// First semester which allowed to use when posting a comment
	'firstAllowedSemester' => '1112A',
	// Latest academic year which the course offerings data is available
	'latestAcademicYearForOffering' => '1415',
	// Current quick access semester
	'currentQuickAccessSemester' => '1415A',
	// Semester codes
	'semesters' => array('A', 'B', 'S'),

	// Number of items shown for the paginator
	'paginate_perPage' => 25,
	'paginate_commentPerPage' => 20,

	// Maximum number of courses shown on the statistics lists
	'home_statsMaxItem' => 10,
    // Minimum number of comments required to be listed in statistics
    'bayesianAvgMinCommentNum' => 10,

	// Maximum length of post excerpt (for meta description and social media sharing)
	'excerptLength' => 250,

	// Number of minute to remember the query result for course list
	'cache_courseList' => 10,

	// Maximum number of posts in RSS feed
	'feed_maxItem' => 25,
	// TTL of RSS feed
	'feed_ttl' => 60,

	// Twitter account associate with Twitter Card meta tag
	'twitterCardSite' => '@swiftzer',

	'facebookInsightsAdminId' => '***REMOVED***',
	'googleAnalyticsUA' => '***REMOVED***',
	'googleAnalyticsDomain' => 'swiftzer.net',

    // reCAPTCHA API key
    'reCaptchaPublicKey' => '***REMOVED***',
    'reCaptchaPrivateKey' => '***REMOVED***',
);