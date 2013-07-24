<?php

class LocaleHelper {
	/**
	 * Generate the URL of this page with the locale you want.
	 * @param  string $locale locale you want
	 * @return string         URL with locale
	 */
	public static function getCurrentPageURLInLocale($locale) {
		// if the input locale is default locale, set it to null
		if ($locale == Config::get('cityuge.availableLocaleURL')[0]) {
			$locale = null;
		}
		// get all URL segments
		$segments = Request::segments();

		// we are in home page
		if (count($segments) == 0) {
			return rtrim(URL::to('/') . '/' . $locale, '/');
		}
		// we are not in home page and the URL contain locale
		if (array_search($segments[0], Config::get('cityuge.availableLocaleURL'))) {
			array_shift($segments);
			return URL::to('/') . '/' . ($locale == null ? '' : $locale . '/') . implode('/', $segments);
		}
		// we are not in home page and the URL don't contain locale
		return URL::to('/') . '/' . ($locale ? $locale . '/' : '') . implode('/', $segments);
	}
}