<?php
namespace Nor\BE;
/*
 * nor-be -- HTTP Exception implementation
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

/** HTTP Exception implementation */
class Exception extends \Exception {

	/** */
	public function __construct($message, $code = 500, \Exception $previous = null) {
		if(HTTPStatusCodes::isCode($message)) {
			$code = $message;
			$message = HTTPStatusCodes::get($code);
		}
		parent::__construct($message, $code, $previous);
	}
}

/* EOF */
?>
