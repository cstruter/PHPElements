<?php

/**
* File Containing HtmlOptionGroupElement Class
*/

namespace CSTruter\Elements;

/**
* Group of child elements of the select element - drop-down list option group
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_optgroup.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlOptionGroupElement extends HtmlElement
{
	/** @var HtmlOptionElement[] collection of option elements */
	private $Children;
	
	/** @var string display text for the option group */
	public $Label;

	/**
	* Constructor
	* @param string $label display text for the option group
	* @param HtmlOptionElement[] $children (Optional) collection of option elements
	*/
	public function __construct($label, array $children = []) 
	{
		$this->Label = $label;
		$this->Children = $children;
	}
	
	/**
	* returns a list of children in the child container (inner elements)
	* returns array
	*/
	public function GetChildren() {
		return $this->Children;
	}
}

?>