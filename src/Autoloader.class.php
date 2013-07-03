<?php
namespace Nor\BE;
/*
 * nor-be -- Autoloader
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

/** Autoloader */
class Autoloader {

	/** Include paths */
	private static $paths = null;

	/** Add new include path */
	public static function initPaths() {
		if(!is_array(self::$paths)) {
			self::$paths = array( dirname(dirname(__FILE__)) . '/include' );
		}
	}

	/** Add new include path */
	public static function addPath($path) {
		self::initPaths();
		self::$paths[] = $path;
	}

	/* Search and load class */
	public static function load($name) {
		self::initPaths();
		foreach(self::$paths as $path) {
			if(file_exists($path . "/" . $name . ".class.php")) {
				require_once($path . "/" . $name . ".class.php");
				return;
			}
		}
	}
}

spl_autoload_register(__NAMESPACE__ .'\Autoloader::load');

/* EOF */
?>
