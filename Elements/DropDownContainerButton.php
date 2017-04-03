<?php

/**
* File Containing DropDownContainerButton Class
*/

namespace CSTruter\Elements;

/**
* DropDown Container Button Class
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerButton extends HtmlElement
{
	/** @var string Text displayed on the button */
	protected $Text;
	
	/**
	* Constructor
	* @param string $text text displayed on the button
	*/
	public function __construct($text) {
		$this->Text = $text;
	}
	
	/**
	* Text Getter
	* @return string
	*/
	public function GetText() {
		return $this->Text;
	}

	/**
	* Text Setter
	* @param string $value property value
	*/
	public function SetText($value) {
		$this->Text = $value;
	}
}

?>