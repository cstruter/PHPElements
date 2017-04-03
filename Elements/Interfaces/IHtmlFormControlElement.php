<?php

/**
* File Containing IHtmlFormControlElement Interface
*/

namespace CSTruter\Elements\Interfaces;

use CSTruter\Elements\HtmlFormElement;

/**
* Methods that needs to be implemented when an element is embedded in a form
* @package CSTruter\Elements\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IHtmlFormControlElement
{
	/**
	* FormElement Getter
	* @return HtmlFormElement
	*/
	function GetForm();
	
	/**
	* FormElement Setter
	* @param HtmlFormElement $formElement parent form this element reports to
	*/
	function SetForm(HtmlFormElement $formElement);
}

?>