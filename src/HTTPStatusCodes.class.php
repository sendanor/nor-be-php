<?php
/*
 * nor-be -- HTTP status codes
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

/** HTTP status codes */
class HTTPStatusCodes {

	private static $http_codes = array(
		200 => 'OK',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		503 => 'Service Unavailable'
	);

	public static function isCode($code) {
		return is_numeric($code) && isset(self::$http_codes[$code]);
	}

	public static function get($code) {
		if(!self::isCode($code)) return "Error";
		return self::$http_codes[$code];
	}

}

/* EOF */
?>
