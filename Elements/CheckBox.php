<?php

/**
* File Containing CheckBox Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\Common\Exceptions\TypeException;

/**
* CheckBox element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class CheckBox extends HtmlFormControlElement
{
	/** @var boolean Checked status of the element */
	protected $Checked = false;
	
	/** @var string CheckBox label text */
	protected $Label;
	
	/** @var HtmlCheckBoxInputElement Raw Html CheckBox element */
	public $FormFieldElement = null;
	
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $label text label displayed next to checkbox
	* @param string $value (Optional) value sent from the element
	*/
	public function __construct($name, $label, $value = null) {
		parent::__construct($name);
		$this->Label = $label;
		$this->FormFieldElement = new HtmlCheckBoxInputElement($name, $value);
	}
	
	/**
	* Checked Getter
	* @return boolean
	*/
	public function GetChecked() {
		return $this->Checked;
	}
	
	/**
	* Checked Setter
	* @param boolean $value Checked or Unchecked (Default: false)
	* @throws TypeException if a non boolean value was assigned the the value argument
	*/
	public function SetChecked($value) {
		$this->Checked = $value;
		$this->FormFieldElement->SetChecked($value);
	}
	
	/**
	* Value Setter
	* @param string $value property value
	*/
	public function SetValue($value) {
		$this->Value = $value;
		$this->FormFieldElement->SetValue($value);
	}
	
	/**
	* Label Getter
	* @return string
	*/
	public function GetLabel() {
		return $this->Label;
	}

	/**
	* Label Setter
	* @param string $value property value
	*/
	public function SetLabel($value) {
		$this->Label = $value;
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
		$this->FormFieldElement->ParentElement = $this;
		$this->FormElement = $formElement;
		$this->FormElement->Children->Add($this);
		$name = $this->GetName();
		if (!$this->FormElement->IsPostBack()) {
			return;
		}
		$userValue = $this->FormElement->GetUserValue($name);
		$isChecked = ($userValue !== null);
		$this->SetChecked($isChecked);
		if ($isChecked) {
			$this->SetValue($userValue);
		}
	}	
}

?>