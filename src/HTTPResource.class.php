<?php
/*
 * nor-be -- HTTP resource implementation
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

require_once('HTTPException.class.php');
require_once('HTTPStatusCodes.class.php');
require_once('JSONRequest.class.php');

/** HTTP Resource */
class HTTPResource {

	/** Constructor */
	public function __construct($method=null, $path=null) {
		$this->method = is_null($method) ? JSONRequest::getMethod() : $method;
		$this->path = is_null($path) ? JSONRequest::getPath() : $path;
	}

	/** Implement default handler for requests */
	public function request() {
		if(!_is_method_valid($this->method)) {
			throw new HTTPException(405);
		}
		if(!method_exists($this, $this->method)) {
			throw new HTTPException(405);
		}
		return call_user_func(array(&$this, $this->method));
	}

}

/* EOF */
return;
?>
