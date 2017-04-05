<?php

/**
* File Containing ListBoxElement Class
*/

namespace CSTruter\Elements;

/**
* ListBox element
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_select.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class ListBoxElement extends HtmlSelectElement
{	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param HtmlOptionElement[]|HtmlOptionGroupElement[] $children array of options and optgroups
	* @param string[] $values (Optional) selected value
	*/
	public function __construct($name, array $children = [], $values = null) {
		$this->Value = [];
		parent::__construct($name, $children, $values);
	}
	
	/**
	* Set selected child
	* @param HtmlOptionElement|HtmlOptionGroupElement $child option or optgroup
	* @param string[] $values selected value
	*/
	protected function SetChild($child, $values) {
		$optionValue = (string)$child;
		$this->OptionValues[] = $optionValue;
		$selected = ($values !== null && in_array($optionValue, $values));
		$child->SetSelected($selected);
		if ($child->GetSelected()) {
			$this->Value[] = $optionValue;
		}
	}
}

?>