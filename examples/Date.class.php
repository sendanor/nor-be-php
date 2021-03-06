<?php

set_include_path('/path/to/git/nor-be-php/include');

require_once('Nor/BE/Resource.class.php');
require_once('Nor/BE/Request.class.php');

/** Implements HTTP resource for requesting current time */
class DateResource extends Nor\BE\Resource {

    /** Get current time */
    public function get() {
        return array('time' => time());
    }

}

// Use the request
Nor\BE\Request::run( new DateResource() );

?>
