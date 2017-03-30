<?php

namespace App\Exceptions;

class ForbiddenException extends IgdbException {

	public $errorType = 'forbidden';
	public $statusCode = 403;

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