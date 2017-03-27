<?php

namespace App\Exceptions;

/**
 * Exception abstract class
 */
abstract class IgdbException extends \Exception
{
    /**
     * The HTTP status code for this exception that should be sent in the response
     */
    public $httpStatusCode = 400;

    /**
     * The exception type
     */
    public $errorType = '';

    /**
     * Throw a new exception
     *
     * @param string $msg Exception Message
     */
    public function __construct($msg = 'An error occured')
    {
        parent::__construct($msg);
    }
}