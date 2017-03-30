<?php

namespace App\Exceptions;

class ValidationException extends IgdbException {

	public $errorType = 'invalid_params';
	public $statusCode = 400;

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