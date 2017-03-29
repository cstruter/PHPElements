<?php

/**
* File Containing HtmlOptionElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Common\Exceptions\TypeException;

/**
* Child element of the select element - drop-down list option
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_option.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlOptionElement extends HtmlElement
{
	/** @var boolean indicates whether or not the element is selected */
	protected $Selected;
	
	/** @var string value to be sent to a server */
	public $Value;
	
	/** @var string text displayed for the option */
	public $Text;
	
	/**
	* Constructor
	* @param string $text the text displayed for the option (or if value not set, value to be sent to a server)
	* @param string $value (Optional) value sent to the server
	* @param boolean $selected (Optional) indicates whether or not the element is selected
	* @throws TypeException if a non boolean value is assigned to the selected argument
	*/
	public function __construct($text, $value = null, $selected = false) 
	{
		if (!is_bool($selected)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Text = $text;
		$this->Value = $value;
		$this->Selected = $selected;
	}
	
	/**
	* Selected Getter
	* @return boolean
	*/
	public function GetSelected() {
		return $this->Selected;
	}
	
	/**
	* Selected Setter
	* @param boolean $value is selected
	* @throws TypeException if a non boolean value is assigned to the value argument
	*/
	public function SetSelected($value) {
		if (!is_bool($value)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Selected = $value;
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