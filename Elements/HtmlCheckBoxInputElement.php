<?php

/**
* File Containing HtmlCheckBoxInputElement Class
*/

namespace CSTruter\Elements;

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
	* @param string $name			used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value			(Optional) value sent from the element
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
	*/
	public function SetChecked($value) {
		$this->Checked = $value;
	}
	
	/**
	* FormElement Setter
	* @param HtmlFormElement $formElement parent form this element reports to
	*/
	public function SetForm(HtmlFormElement $formElement) {
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