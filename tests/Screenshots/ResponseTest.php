<?php

use totaldev\browserstack\screenshots\response;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    public function testSetApiResponse()
    {
        $response = new Response();

        $myArray = ["foo" => "bar"];

        $response->setApiResponse(json_encode($myArray));

        $this->assertEquals($myArray, $response->getResponse());
    }
}