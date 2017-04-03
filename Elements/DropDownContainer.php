<?php

/**
* File Containing DropDown Container Class
*/

namespace CSTruter\Elements;

/**
* DropDown Container Element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainer extends HtmlElement
{
	/** @var string name of the element used to identify element in client side DOM */
	protected $Name;
	
	/** @var string a client side callback that fires when the dropdown content changed */
	public $OnButtonChanged = null;
	
	/** @var DropDownContainerButton The element that toggles the dropdown */
	protected $Button;
	
	/** @var DropDownContainerContent The elements displayed within the dropdown */
	protected $Content;
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param string $text text displayed on the dropdown button 
	* @param HtmlElement $element added to the dropdown content
	*/
	public function __construct($name, $text, $element) {
		$this->Name = $name;
		$this->Content = new DropDownContainerContent($element);
		$this->Button = new DropDownContainerButton($text);
	}
	
	/**
	* Button Getter
	* @return DropDownContainerButton
	*/
	public function GetButton() {
		return $this->Button;
	}
	
	/**
	* Content Getter
	* @return DropDownContainerContent
	*/
	public function GetContent() {
		return $this->Content;
	}
	
	/**
	* Name Getter
	* @return string
	*/
	public function GetName() {
		return $this->Name;
	}
}

?>