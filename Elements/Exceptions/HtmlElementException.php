<?php

/**
* File Containing HtmlFormControlElement Class
*/

namespace CSTruter\Elements\Exceptions;

/**
* Html Element Exception - Thrown whenever an element is used incorrectly
* @package CSTruter\Elements\Exceptions
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlElementException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

?>