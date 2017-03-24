<?php

/**
* File Containing HtmlPasswordInputElement Class
*/

namespace CSTruter\Elements;

/**
* Password input element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlPasswordInputElement extends HtmlInputElement
{
	/**
	* Constructor
	* @param string $name			used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value			(Optional) value displayed and sent from the element 
	* @param string $requestMethod	(Optional) GET or POST - if not set see HtmlSettings
	*/
	public function __construct($name, $value = null, $requestMethod = null) {
		parent::__construct($name, 'password', $value, $requestMethod);
	}
}

?>