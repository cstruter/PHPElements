<?php

/**
* File Containing HtmlOptionElement Class
*/

namespace CSTruter\Elements;

/**
* Child element of the select element - drop-down list option
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_option.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlOptionElement extends HtmlElement
{
	/** @var boolean when set to false, the element will be unselectable */
	public $Disabled;
	
	/** @var boolean indicates whether or not the element is selected */
	public $Selected;
	
	/** @var string value to be sent to a server */
	public $Value;
	
	/** @var string text displayed for the option */
	public $Text;
	
	/**
	* Constructor
	* @param string $text		the text displayed for the option (or if value not set, value to be sent to a server)
	* @param string $value		(Optional) value sent to the server
	* @param boolean $selected	(Optional) indicates whether or not the element is selected
	* @param boolean $disabled	(Optional) when set to false the element will be unselectable
	*/
	public function __construct($text, $value = null, $selected = false, $disabled = false) 
	{
		$this->Text = $text;
		$this->Value = $value;
		$this->Selected = $selected;
		$this->Disabled = $disabled;
	}
	
	/**
	* custom toString method
	* @return string returns the value that will be sent to the server, if value is null return text property
	*/
	public function __toString() {
        return (string)(($this->Value === null) ? $this->Text : $this->Value);
    }
}

?>