<?php

/**
* File Containing DropDownContainerFormControl Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Interfaces\IHtmlFormControlElement;

/**
* DropDownContainerFormControl Element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerFormControl
extends DropDownContainer
implements IHtmlFormControlElement
{
	/** @var HtmlElement The element displayed within the dropdown */
	public $Element;
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param string $text text displayed on the dropdown button 
	* @param HtmlElement $element added to the dropdown content
	*/
	public function __construct($name, $text, $element) {
		$class = str_replace("\\", '.', get_class($element));
		$this->Element = $element;
		$this->OnButtonChanged = "$class('$name').AttachDropDownContainerEvents()";
		parent::__construct($name, $text, $this->Element);
	}
	
	/**
	* FormElement Setter
	* @param HtmlFormElement $formElement parent form this element reports to
	* @throws HtmlElementException if this method is called a second time
	*/
	public function SetForm(HtmlFormElement $formElement) {
		$this->Element->SetForm($formElement);
	}
	
	/**
	* FormElement Getter
	* @return HtmlFormElement
	*/
	public function GetForm() {
		return $this->Element->GetForm();
	}	
}

?>