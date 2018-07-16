<?php

/**
* Get an associative array with localeCodes as keys and translated URLs of current page as value
*/
function getLocalizedURLArray($removeQueryString = false)
{
    $localesOrdered = LaravelLocalization::getLocalesOrder();
    $localizedURLs = array();
    foreach ($localesOrdered as $localeCode => $properties) {
        if ($localeCode != config('app.locale')) {
            $url = LaravelLocalization::getLocalizedURL(false, null, [], true);
        }
        else {
            $url = LaravelLocalization::getLocalizedURL($localeCode, null, [], true);
        }
        if ($removeQueryString) {
            $parsedUrl = parse_url($url);
            unset($parsedUrl['query']);
            $url = \Guzzle\Http\Url::buildUrl($parsedUrl);
        }
        $localizedURLs[$localeCode] = $url;
    }
    return $localizedURLs;
}