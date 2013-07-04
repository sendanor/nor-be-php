<?php
namespace Nor\BE;
/*
 * nor-be -- Autoloader
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

require_once('ErrorLog.class.php');

/** Autoloader */
class Autoloader {

	/** Include paths */
	private static $paths = null;

	/** Add new include path */
	public static function initPaths() {
		if(is_null(self::$paths)) {
			self::$paths = array( dirname(dirname(__FILE__)) . '/include' );
		}
	}

	/** Add new include path */
	public static function addPath($path) {
		self::initPaths();
		self::$paths[] = $path;
	}

	/** Constructor */
	public function __construct() {
		ErrorLog::write("DEBUG: Autoloader started");
		spl_autoload_register(array($this, 'loader'));
	}

	/** Unregister autoloader */
	public function __destruct() {
		ErrorLog::write("DEBUG: Autoloader stopped");
		spl_autoload_unregister(array($this, 'loader'));
	}

	/* Search and load class */
	public static function loader($name) {
		self::initPaths();
		foreach(self::$paths as $path) {
			ErrorLog::write("Testing path ", $name, $path);
			if(is_readable($path . "/" . $name . ".class.php")) {
				require_once($path . "/" . $name . ".class.php");
				return;
			}
		}
	}
}

return new Autoloader();

/* EOF */
?>
