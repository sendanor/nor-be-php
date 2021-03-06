<?php
namespace Nor\BE;
/*
 * nor-be -- HTTP resource implementation
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

/** HTTP Resource */
class Resource {

	/** Constructor */
	public function __construct($method=null, $path=null) {
		$this->method = is_null($method) ? Request::getMethod() : $method;
		$this->path = is_null($path) ? Request::getPath() : $path;
	}

	/** Implement default handler for requests */
	public function request() {
		if(!Request::isMethodValid($this->method)) {
			throw new Exception(405);
		}
		if(!method_exists($this, $this->method)) {
			throw new Exception(405);
		}
		return call_user_func(array(&$this, $this->method));
	}

}

/* EOF */
return;
?>
