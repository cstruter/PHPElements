<?php

/**
* File Containing HtmlFormControlElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\Elements\Interfaces\IHtmlFormControlElement;

/**
* Base class used for all html controls, e.g. returns a value to the server via a form
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
abstract class HtmlFormControlElement 
extends HtmlElement
implements IHtmlFormControlElement
{
	/** @var HtmlFormElement the parent form this control reports to */
	protected $FormElement;
	
	/** @var string name of the element used in request and to identify element in client side DOM */
	protected $Name;
	
	/** @var string value returned to/from the server */
	protected $Value;
	
	/**
	* Constructor
	* @param string $name name of the element 
	*/
	public function __construct($name) {
		$this->Name = $name;
	}
	
	/**
	* Value Getter
	* @return string
	*/
	public function GetValue() {
		return $this->Value;
	}

	/**
	* Value Setter
	* @param string $value property value
	*/
	public function SetValue($value) {
		$this->Value = $value;
	}	
	
	/**
	* Name Getter
	* @return string
	*/
	public function GetName() {
		return $this->Name;
	}
	
	/**
	* FormElement Setter
	* @param HtmlFormElement $formElement parent form this element reports to
	* @throws HtmlElementException if this method is called a second time
	*/
	public function SetForm(HtmlFormElement $formElement) {
		if ($this->FormElement !== null) {
			throw new HtmlElementException('This element is already assigned to a form', 10000);
		}
		$this->FormElement = $formElement;
		$this->FormElement->Children->Add($this);
		$name = $this->GetName();
		if (!$this->FormElement->IsPostBack()) {
			return;
		}
		$userValue = $this->FormElement->GetUserValue($name);
		if ($userValue !== null) {
			$this->SetValue($userValue);
		}
	}
	
	/**
	* FormElement Getter
	* @return HtmlFormElement
	*/
	public function GetForm() {
		return $this->FormElement;
	}
}

?>