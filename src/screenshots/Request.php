<?php

namespace totaldev\browserstack\Screenshots;

/**
 * Class Request
 *
 * A simple Class to build up Screenshot Requests
 *
 * @package totaldev\browserstack\Screenshots
 */
class Request
{

    /**
     * An array containing arrays of os/browser combinations
     *
     * @var array
     */
    public $browsers = [];
    /* Optional parameter that is needed only for Screenshots on mobile devices
     * @var
     */
    /**
     * Required if results are to be sent back to a public URL
     *
     * @var string
     */
    public $callbackUrl = '';
    public $device;
    /**
     * Required if the page is local and that a Local Testing connection has been set up.
     *
     * @var string
     */
    public $local = '';
    /**
     * The Resolution screenshots on OSX-based systems are generated
     * Values: 1024x768, 1280x960, 1280x1024, 1600x1200, 1920x1080
     *
     * @var string
     */
    public $macRes = '';
    /**
     * Optional parameter that is needed only for Screenshots on mobile devices
     * Possible values: portrait, landscape
     * Default: portrait
     *
     * @var string
     */
    public $orientation = 'portrait';
    /**
     * The Quality of the generated screenshot
     * Possible values: compressed, original
     *
     * @var string
     */
    public $quality = '';
    /**
     * URL of the Website you want to make a screenshot from
     * Example: http://www.example.com
     * @var
     */
    public $url;
    /**
     * Required if specifying the time (in seconds) to wait before taking the screenshot.
     *
     * @var int
     */
    public $waitTime = 2;
    /**
     * The Resolution screenshots on Windows-based systems are generated
     * Values: 1024x768, 1280x1024
     *
     * @var string
     */
    public $winRes = '';

    /**
     * Short-hand function to build a request with a single browser/OS combination
     *
     * @param $url
     * @param $os
     * @param $osVersion
     * @param $browser
     * @param $browserVersion
     * @return Request
     */
    public static function buildRequest($url, $os, $osVersion, $browser, $browserVersion)
    {
        $request = new self;
        $request->url = $url;
        $request->addBrowser($os, $osVersion, $browser, $browserVersion);

        return $request;
    }

    /**
     * Adds a OS/Browser-Combination to the list of requested browsers
     * Optional parameter device is required for mobile devices
     *
     * @param $os
     * @param $osVersion
     * @param $browser
     * @param $browserVersion
     * @param null $device
     */
    public function addBrowser($os, $osVersion, $browser, $browserVersion, $device = null)
    {
        $this->browsers[] = [
            'os' => $os,
            'os_version' => $osVersion,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'device' => $device,
        ];
    }
}