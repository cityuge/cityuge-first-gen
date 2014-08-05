<?php

class LocaleHelper
{
    /**
     * Generate the URL of this page with the locale you want.
     * @param  string $locale locale you want
     * @return string         URL with locale
     */
    public static function getCurrentPageURLInLocale($locale)
    {
        // if the input locale is default locale, set it to null
        $configAvailableLocaleURL = Config::get('cityuge.availableLocaleURL');
        if ($locale === $configAvailableLocaleURL[0]) {
            $locale = null;
        }
        // get all URL segments
        $segments = Request::segments();

        // we are in home page and no locale attached
        if (count($segments) == 0) {
            return rtrim(URL::to('/') . '/' . $locale, '/');
        }
        // the URL contain locale
        if (array_search($segments[0], Config::get('cityuge.availableLocaleURL'))) {
            array_shift($segments);
            // not to add trailing slash if it is in home page
            if (count($segments) === 0) {
                return URL::to('/') . '/' . ($locale == null ? '' : $locale);
            }
            return URL::to('/') . '/' . ($locale == null ? '' : $locale . '/') . implode('/', $segments);
        }
        // we are not in home page and the URL don't contain locale
        return URL::to('/') . '/' . ($locale ? $locale . '/' : '') . implode('/', $segments);
    }

    public static function getIsoLocale()
    {
        $locale = Config::get('app.locale');
        $localeIndex = array_search($locale, Config::get('cityuge.availableLocale'));
        $availableLocaleISOs = Config::get('cityuge.availableLocaleISO');

        return $availableLocaleISOs[$localeIndex];
    }
}