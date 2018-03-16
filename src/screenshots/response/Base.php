<?php

namespace totaldev\browserstack\screenshots\response;

/**
 * Class Base
 * @package totaldev\browserstack\screenshots\response
 */
class Base
{

    public $response;

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $apiResponse
     */
    public function setApiResponse($apiResponse)
    {
        $this->response = $apiResponse;
    }

}