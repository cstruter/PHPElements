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
	
	/** @var boolean disable the element */
	public $Disabled;
	
	/** @var string display text for the option group */
	public $Label;

	/**
	* Constructor
	* @param string $label display text for the option group
	* @param HtmlOptionElement[] $children (Optional) collection of option elements
	* @param boolean $disabled 	(Optional) disable the element
	*/
	public function __construct($label, array $children = [], $disabled = false) 
	{
		$this->Label = $label;
		$this->Disabled = $disabled;
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