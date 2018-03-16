<?php

namespace totaldev\browserstack\screenshots;

/**
 * Class Response
 *
 * Base Class to build a JSON response
 *
 * @package totaldev\browserstack\Screenshots
 */
class Response
{
    /**
     * @var
     */
    private $_response;

    /**
     * Get the API response as an associative array
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Sets the response in JSON format
     *
     * @param $apiResponse string JSON
     */
    public function setApiResponse($apiResponse)
    {
        $this->_response = json_decode($apiResponse, true);
    }

}