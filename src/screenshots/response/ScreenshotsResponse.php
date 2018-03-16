<?php

namespace totaldev\browserstack\screenshots\response;

class ScreenshotsResponse extends Base
{

    const ERROR_LIMIT_REACHED = 'Paralell limit reached';
    const ERROR_INVALID_REQUEST = 'Invalid Request';
    const ERROR_VALIDATION_FAILED = 'Validation failed';
    const ERROR_AUTHENTICATION_FAILED = 'Authentication failed. Please check your login details and retry.';

    // Validation failed (Contains extra Array errors with objects code and field.
    /**
     * If provided, contains the fields that caused an error at browserstack
     * @var array
     */
    public $errorFields = [];
    /**
     * If provided, contains the Error Message from browserstack
     *
     * @var bool
     */
    public $errorMessage = false;
    /**
     * Contains an Array of failed screenshots
     *
     * @var
     */
    public $failedScreenshots;
    /**
     * Contains an Array of finished screenshots
     *
     * @var
     */
    public $finishedScreenshots;
    /**
     * Indicates if the request was successful
     * Should be used first
     *
     * A not finished Request is also a successful.
     *
     * @var bool
     */
    public $isSuccessful = false;
    /**
     * If this is true, the parallel limit was reached and the request has not been made
     *
     * @var bool
     */
    public $isThrottled = false;
    /**
     * If the request was successful contains the browserstack Job ID
     * needed to query the JOB status
     *
     * @var bool
     */
    public $jobId = false;
    /**
     * Contains an Array of pending screenshots
     *
     * @var
     */
    public $pendingScreenshots;

    public function __construct($apiResponse)
    {
        parent::setApiResponse($apiResponse);
        $this->parse();
    }

    /**
     * If there are no pending screenshots the request is considered as finished
     *
     * @return bool
     */
    public function isFinished()
    {
        if (isset($this->response) && count($this->pendingScreenshots) == 0) {
            return true;
        }

        return false;
    }

    /**
     * Parse the JSON response from browserstack
     *
     * @return bool
     */
    public function parse()
    {
        if (is_string($this->response) && $this->response === self::ERROR_AUTHENTICATION_FAILED) {
            $this->errorMessage = self::ERROR_AUTHENTICATION_FAILED;
        }

        $this->response = json_decode($this->response);

        if (!$this->response) {
            return false;
        }

        $this->finishedScreenshots = [];
        $this->pendingScreenshots = [];

        if (isset($this->response->message)) {
            if ($this->response->message === 'Parallel limit reached') {
                $this->isThrottled = true;
            }

            $this->errorMessage = $this->response->message;
            if (isset($this->response->errors)) {
                $this->errorFields = $this->response->errors;
            }
        }
        if (isset($this->response->screenshots) && count($this->response->screenshots) > 0) {
            $this->isSuccessful = true;

            foreach ($this->response->screenshots as $screenshot) {
                if ($screenshot->state == 'done') {
                    $this->finishedScreenshots[] = $screenshot;
                } elseif ($screenshot->state == 'pending' || $screenshot->state == 'processing') {
                    $this->pendingScreenshots[] = $screenshot;
                } elseif ($screenshot->state == 'timed-out' || $screenshot->state == 'failed') {
                    $this->failedScreenshots[] = $screenshot;
                }
            }
        }
        if (isset($this->response->job_id)) {
            $this->jobId = $this->response->job_id;
        } elseif (isset($this->response->id)) {
            $this->jobId = $this->response->id;
        } else {
            $this->isSuccessful = false;
            return false;
        }

        return $this->jobId;

    }

}