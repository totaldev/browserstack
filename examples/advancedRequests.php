<?php

require __DIR__ . '/../vendor/autoload.php';

/*
 * This an example of the more advanced way of building requests
 * 
 */

use totaldev\browserstack\screenshots\Api;
use totaldev\browserstack\screenshots\Request;

const BROWSERSTACK_ACCOUNT = '';
const BROWSERSTACK_PASSWORD = '';

$api = new Api(BROWSERSTACK_ACCOUNT, BROWSERSTACK_PASSWORD);

$request = new Request();
$request->url = 'http://vrer.ru';
$request->macRes = '1920x1080';
$request->winRes = '1920x1080';
$request->quality = 'Original';
$request->waitTime = 10;
$request->orientation = 'landscape';

$request->addBrowser('ios', '8.0', 'Mobile Safari', null, 'iPhone 6');
$request->addBrowser('ios', '8.0', 'Mobile Safari', null, 'iPhone 6 Plus');
$request->addBrowser('Windows', 'XP', 'ie', '7.0');

// Send the request
$api->sendRequest($request);

// Output
var_dump($request);