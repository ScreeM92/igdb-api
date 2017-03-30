<?php

namespace App\Exceptions;

class NotFoundException extends IgdbException {

    public $errorType = 'not_found';
    public $statusCode = 404;

    function __construct($message = "") {
        parent::__construct($message);
    }

    function getErrorType() {
        return $this->errorType;
    }

    function getStatusCode() {
        return $this->statusCode;
    }
}