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
	private $paths = null;

	/** Add new include path */
	public function addPath($path) {
		$this->paths[] = $path;
	}

	/** Constructor */
	public function __construct() {
		ErrorLog::write("DEBUG: Autoloader started");
		$this->paths = array( dirname(dirname(__FILE__)) . '/include' );
		spl_autoload_register(array($this, 'loader'));
	}

	/** Unregister autoloader */
	public function __destruct() {
		ErrorLog::write("DEBUG: Autoloader stopped");
		spl_autoload_unregister(array($this, 'loader'));
	}

	/* Search and load class */
	public function loader($name) {
		foreach($this->paths as $path) {
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
