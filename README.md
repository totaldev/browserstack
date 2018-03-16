browserstack
============
[![Latest Stable Version](https://poser.pugx.org/totaldev/browserstack/v/stable)](https://packagist.org/packages/totaldev/browserstack) [![Total Downloads](https://poser.pugx.org/totaldev/browserstack/downloads)](https://packagist.org/packages/totaldev/browserstack)

An easy-to-use PHP library for the browserstack Screenshots API. Working examples included.

## Install

Install via [composer](https://getcomposer.org):

```javascript
{
    "require": {
        "totaldev/browserstack": "0.0.2"
    }
}
```

Run `composer install`.

## Example usage

#### Get an array of available browsers

```php
use totaldev\browserstack\screenshots\Api;
$api         = new Api('username', 'password');
$browserList = $api->getBrowsers();
```

#### Generate a screenshot
```php
use totaldev\browserstack\screenshots\Api;
use totaldev\browserstack\screenshots\Request;
$api        = new Api('account', 'password');
$request    = Request::buildRequest('http://www.example.org', 'Windows', '8.1', 'ie', '11.0');
$response   = $api->sendRequest( $request );
$jobId      = $response->jobId;
```

#### Query information about the request

```php
$status = $api->getJobStatus('browserstack_jobid');
if ($status->isFinished()) {
  foreach ($status->finishedScreenshots as $screenshot) {
    print $screenshot->image_url ."\n";
  }
}
```


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/totaldev/browserstack/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

