<?php

/**
* File Containing HtmlRadioBoxInputElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\Common\Exceptions\TypeException;

/**
* Radio input element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlRadioBoxInputElement extends HtmlCheckBoxInputElement
{
	/** @var string group of radio elements this radio element belongs to */
	protected $GroupName = null;
	
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value (Optional) value sent from the element
	*/
	public function __construct($name, $value = null) {
		parent::__construct($name, 'radio', $value);
	}
	
	/**
	* GroupName Getter
	* @return string
	*/
	public function GetGroupName() {
		return $this->GroupName;
	}
	
	/**
	* GroupName Setter
	* @param string $value 
	*/
	public function SetGroupName($value) {	
		$this->GroupName = $value;
	}
}

?>