<?php

/**
* File Containing HtmlSelectElement Class
*/

namespace CSTruter\Elements;

/**
* Select element - drop-down list
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_select.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlSelectElement extends HtmlFormControlElement
{
	/** @var boolean Perform a post back to the server when a new option is selected */
	public $AutoPostBack = false;
	
	/** @var string a client side callback that will be fired when the selected option changes */
	public $OnClientChange = null;
	
	/** @var HtmlChildElements inner / child elements */
	public $Children;
	
	/** @var string[] internal list used to check for duplicate values */
	private $OptionValues = [];
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param HtmlOptionElement[]|HtmlOptionGroupElement[] $children array of options and optgroups
	* @param string $value (Optional) selected value
	* @param boolean $disabled (Optional) disable the element
	* @param string $requestMethod (Optional) GET or SET - defaults to HtmlSettings 
	*/
	public function __construct($name, 
		array $children = [], 
		$value = null,
		$disabled = false,
		$requestMethod = null)
	{
		parent::__construct($name, $disabled);
		$userValue = $this->GetUserValue($requestMethod);
		$this->SetChildren($children, ($userValue === null) ? $value : $userValue);
	}

	/**
	* Set selected child
	* @param HtmlOptionElement|HtmlOptionGroupElement $child option or optgroup
	* @param string $value selected value
	*/
	private function setChild($child, $value) {
		$optionValue = (string)$child;
		$this->OptionValues[] = $optionValue;
		$child->Selected = ($optionValue == $value);
		if ($child->Selected) {
			$this->Value = $optionValue;
		}
	}

	/**
	* Value Setter - Set the selected value of the drop-down list
	* @param string $value selected value
	*/
	public function SetValue($value) {
		$this->OptionValues = [];
		$children = $this->Children->Get();
		foreach($children as $child) {
			if ($child instanceof HtmlOptionElement) {
				$this->setChild($child, $value);
			} else if ($child instanceof HtmlOptionGroupElement) {
				$groupChildren = $child->GetChildren();
				foreach($groupChildren as $groupChild) {
					$this->setChild($groupChild, $value);
				}
			} else {
				throw new \Exception("Type of HtmlOptionElement expected in drop-down list $this->Name");
			}
		}
	}
	
	/**
	* Add a list of options /optgroups to the drop-down list
	* @param HtmlOptionElement[]|HtmlOptionGroupElement[] $children array of options and optgroups
	* @param string $value selected value
	*/
	public function SetChildren(array $children, $value = null)
	{
		$this->Children = new HtmlChildElements($children);
		$this->SetValue($value);
		
		if (count($this->OptionValues) != count(array_unique($this->OptionValues))) {
			throw new \Exception("Non unique values assigned to drop-down list $this->Name");
		}		
	}
}

?>