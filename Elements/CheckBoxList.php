<?php

/**
* File Containing CheckBoxList Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException;

/**
* List of Checkboxes
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class CheckBoxList extends HtmlFormControlElement
{
	/** @var HtmlChildElements inner / child elements */
	public $Children;
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param CheckBox[] $children array of checkboxes
	* @param string[] $values (Optional) selected values
	*/
	public function __construct($name, array $children = [], $values = null)
	{
		parent::__construct($name);
		$this->SetChildren($children, $values);
	}

	/**
	* Value Setter - Set the selected value of the drop-down list
	* @param string[] $values selected values
	* @throws HtmlElementException if a checkbox without a set value is found
	*/
	public function SetValue($values) {
		$children = $this->Children->Get();
		foreach($children as $child) {
			$value = $child->GetValue();
			if ($value === null) {
				throw new HtmlElementException('In this context a checkbox requires a default value', 10013);
			}
			$child->SetChecked(in_array($value, $values));
		}
	}
	
	/**
	* Add a list of options /optgroups to the drop-down list
	* @param HtmlOptionElement[]|HtmlOptionGroupElement[] $children array of options and optgroups
	* @param string[] $value selected value
	*/
	public function SetChildren(array $children, $value = null)
	{
		$this->Children = new HtmlChildElements($children);	
		$this->SetValue($value);
	}
	
	/**
	* FormElement Setter
	* @param HtmlFormElement $formElement parent form this element reports to
	* @throws HtmlElementException if this method is used a second time
	*/
	public function SetForm(HtmlFormElement $formElement) {
		if ($this->FormElement !== null) {
			throw new HtmlElementException('This element is already assigned to a form', 10000);
		}		
		$this->FormElement = $formElement;
		$this->FormElement->Children->Add($this);
		$children = $this->Children->Get();
		foreach($children as $child) {
			$child->FormElement = $formElement;
			$name = $child->GetName();
			if ($child->FormElement->IsPostBack()) {
				$userValue = $child->FormElement->GetUserValue($name);
				$child->SetChecked($userValue !== null);
			}
		}
	}	
}

?>