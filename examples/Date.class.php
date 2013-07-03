<?php

require('../src/Resource.class.php');

/** Implements HTTP resource for requesting current time */
class DateResource extends HTTPResource {

	/** Get current time */
	public function get() {
		return array('time' => time());
	}

}

// Use the request
HTTPRequest::run( new DateResource() );

?>
