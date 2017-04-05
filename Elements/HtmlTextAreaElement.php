<?php

/**
* File Containing HtmlTextAreaElement Class
*/

namespace CSTruter\Elements;

/**
* Html TextArea element
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_textarea.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlTextAreaElement extends HtmlFormControlElement
{
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value (Optional) value displayed and sent from the element
	*/
	public function __construct($name, $value = null)
	{
		parent::__construct($name);
		$this->SetValue($value);
	}
}

?>