<?php

/**
* File Containing DropDownContainerContent Class
*/

namespace CSTruter\Elements;

/**
* DropDown Content Container Class
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerContent extends HtmlElement
{	
	/** @var HtmlElement The element displayed with the dropdown */
	public $Element;
	
	/**
	* Constructor
	* @param HtmlElement element added to the dropdown content
	*/
	public function __construct($element) {
		$this->Element = $element;
	}
	
	/**
	* Element Getter
	* @return string
	*/
	public function GetElement() {
		return $this->Element;
	}
}

?>