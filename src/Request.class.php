<?php
namespace Nor\BE;
/*
 * nor-be -- JSON-based HTTP request implementation
 * Copyright 2013 Sendanor <info@sendanor.com>
 *           2013 Jaakko-Heikki Heusala <jheusala@iki.fi>
 * https://github.com/Sendanor/nor-be-php
 */

if(!class_exists('Exception')) {
	require_once('Exception.class.php');
}

if(!class_exists('HTTPStatusCodes')) {
	require_once('HTTPStatusCodes.class.php');
}

/** @fixme Implement base class */
class Request {

	/** Resolve HTTP request successfully with $data */
	public static function resolve($data) {
		if($data instanceof \Exception) {
			return self::reject($data);
		}
		header('Content-Type: application/json');
		echo json_encode($data) . "\n";
		exit();
	}

	/** Response with rejected HTTP request with $data */
	public static function reject($data, $status) {

		if($data instanceof Exception) {
			$status = $data->getCode();
			$data = array('type'=>'error', 'msg'=>$data->getMessage(), 'code'=>$status);
		} else if($data instanceof \Exception) {
			$status = 500;
			$data = array('type'=>'error', 'msg'=>HTTPStatusCodes::get($status), 'code'=>$status);
		} else if(HTTPStatusCodes::isCode($data)) {
			$status = $data;
			$data = array('type'=>'error', 'msg'=>HTTPStatusCodes::get($status), 'code'=>$status);
		}

		if (function_exists('http_response_code')) {
			http_response_code($status);
		} else {
			header(':', true, $status);
		}
		header('Content-Type: application/json');
		echo json_encode($data) . "\n";
		exit();
	}

	/* Get resource path */
	public static function getPath() {
		if(isset($_SERVER['PATH_INFO'])) {
			return substr($_SERVER['PATH_INFO'], 1);
		}
		if(isset($_GET['_path'])) {
			return $_GET['_path'];
		}
		return "";
	}

	/** Returns true if method is one of the accepted types */
	public static function isMethodValid($method) {
		return in_array(strtolower($method), array('get', 'post', 'delete', 'put', 'head', 'patch'), true);
	}

	/* Get action */
	public static function getMethod() {
		if(isset($_SERVER['REQUEST_METHOD'])) {
			if(strtolower($_SERVER['REQUEST_METHOD']) === "post") {
				if(isset($_POST['_method']) && self::isMethodValid($_POST['_method']) ) {
					return strtolower($_POST['_method']);
				}
			}
			return strtolower($_SERVER['REQUEST_METHOD']);
		}
		return 'get';
	}

	/* Default request runner */
	public static function run($res) {
		try {
			Request::resolve( $res.request() );
		} catch(\Exception $e) {
			Request::reject($e);
		}
	}

}

/* EOF */
return;
?>
