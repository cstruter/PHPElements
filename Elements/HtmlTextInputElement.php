<?php

/**
* File Containing HtmlTextInputElement Class
*/

namespace CSTruter\Elements;

/**
* Textbox input element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlTextInputElement extends HtmlInputElement
{
	/**
	* Constructor
	* @param string $name			used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value			(Optional) value displayed and sent from the element
	*/
	public function __construct($name, $value = null) {
		parent::__construct($name, 'text', $value);
	}
}

?>