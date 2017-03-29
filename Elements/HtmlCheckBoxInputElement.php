<?php

/**
* File Containing HtmlCheckBoxInputElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\Common\Exceptions\TypeException;

/**
* Textbox input element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlCheckBoxInputElement extends HtmlInputElement
{
	/** @var boolean Checked status of the element */
	protected $Checked = false;
	
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value (Optional) value sent from the element
	*/
	public function __construct($name, $value = null) {
		parent::__construct($name, 'checkbox', $value);
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
		if (!is_bool($value)) {
			throw new TypeException('Type bool expected', 1);
		}		
		$this->Checked = $value;
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
		$name = $this->GetName();
		$userValue = $this->FormElement->GetUserValue($name);
		$isChecked = ($userValue !== null);
		$this->SetChecked($isChecked);
		if ($isChecked) {
			$this->SetValue($userValue);
		}
	}	
}

?>