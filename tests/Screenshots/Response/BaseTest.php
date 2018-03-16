<?php

use totaldev\browserstack\screenshots\response\Base;

class BaseTest extends PHPUnit_Framework_TestCase
{
    public function testGetResponse()
    {
        $response = new Base();

        $myArray = ["foo" => "bar"];
        $response->response = $myArray;

        $this->assertEquals($myArray, $response->getResponse());
    }

    public function testSetApiResponse()
    {
        $response = new Base();
        $myArray = ["foo" => "bar"];

        $myObject = new StdClass();
        $myObject->foo = "bar";

        $response->setApiResponse(json_encode($myArray));
        $this->assertEquals($myObject, $response->getResponse());
    }
}