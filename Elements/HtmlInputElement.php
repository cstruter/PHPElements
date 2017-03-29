<?php

/**
* File Containing HtmlInputElement Class
*/

namespace CSTruter\Elements;

/**
* Base class all input elements inherit from. 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
abstract class HtmlInputElement extends HtmlFormControlElement
{
	/** @var string type of input element, e.g. hidden, text, button... */
	protected $Type;
	
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $type the input type for the element, e.g hidden, text, button...
	* @param string $value (Optional) value displayed and sent from the element
	*/
	public function __construct($name, $type, $value = null)
	{
		parent::__construct($name);
		$this->Type = $type;
		$this->SetValue($value);
	}
	
	/**
	* returns type of input element, e.g. hidden, text, button...
	* @return string
	*/
	public function GetType() {
		return $this->Type;
	}
}

?>