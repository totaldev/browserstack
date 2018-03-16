<?php

use totaldev\browserstack\screenshots\Api;
use totaldev\browserstack\screenshots\Request;

class ApiTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Api
     */
    protected static $browserstackApi;

    public static function setUpBeforeClass()
    {
        self::$browserstackApi = new Api('phpunit', 'phpunit');
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\totaldev\browserstack\screenshots\Api', self::$browserstackApi);
    }

    public function testGetBrowsers()
    {
        $response = self::$browserstackApi->getBrowsers();

        // Check if we have a valid JSON response
        $this->assertInternalType('array', $response);
    }

    public function testGetJobStatus()
    {
        $this->assertInstanceOf('totaldev\browserstack\screenshots\response\ScreenshotsResponse', self::$browserstackApi->getJobStatus('123'));
    }

    public function testIsbrowserstackAccessable()
    {
        $response = self::$browserstackApi->isbrowserstackAccessible();

        $result = false;

        if (is_array($response) && (isset($response['success']) || isset($response['errors']))) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    public function testSendRequest()
    {
        $request = Request::buildRequest(
            'http://www.example.com',
            'Windows',
            '8.1',
            'ie',
            '11.0'
        );

        $this->assertInstanceOf('totaldev\browserstack\screenshots\Request', $request);

        $response = self::$browserstackApi->sendRequest($request);

        $this->assertInstanceOf('totaldev\browserstack\screenshots\response\ScreenshotsResponse', $response);

        return false;
    }


}