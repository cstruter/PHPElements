<?php

/**
* File Containing CheckBoxList Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\DataSource\KeyValueSource;

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
	* @param KeyValueSource $datasource datasource used to create checkboxes
	* @param string[] $values (Optional) selected values
	*/
	public function __construct($name, KeyValueSource $datasource, $values = null)
	{
		parent::__construct($name);
		$this->SetChildren($datasource, $values);
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
	* Value Getter
	* @return string[]
	*/
	public function GetValue() {
		$checkboxes = $this->Children->Get();
		$value = [];
		foreach($checkboxes as $checkbox) {
			if ($checkbox->GetChecked())
				$value[] = $checkbox->GetValue(); 
		}
		return $value;
	}
	
	/**
	* Add a datasource to the CheckBoxList
	* @param KeyValueSource $datasource datasource used to generate checkboxes
	* @param string[] $value selected value
	*/
	public function SetChildren(KeyValueSource $datasource, $value = null)
	{
		$name = $this->GetName();
		$items = $datasource->GetSource();
		$this->Children = new HtmlChildElements();
		foreach ($datasource->GetSource() as $key => $item) {
			$child = new CheckBox($name.'_'.$key, $item->Key, $item->Value);
			$this->Children->Add($child);
		}
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