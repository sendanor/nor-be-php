<?php
namespace Nor\BE;

/** Error log implementation */
class ErrorLog {

	static protected $stderr = null;

	static public function write() {
		$msg = array();
		$args = func_get_args();
		foreach($args as $arg) {
			if(is_string($arg)) {
				$msg[] = $arg;
			} else {
				$msg[] = var_export($arg, true);
			}
		}
		if(is_null(self::$stderr)) {
			self::$stderr = fopen('php://stderr', 'w');
		}
		fwrite(self::$stderr, implode(" ", $msg) . "\n");
	}

}

/* EOF */
?>
