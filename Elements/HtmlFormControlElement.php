<?php

/**
* File Containing HtmlFormControlElement Class
*/

namespace CSTruter\Elements;

/**
* Base class used for all html controls, e.g. returns a value to the server via a form
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
abstract class HtmlFormControlElement extends HtmlElement
{
	/** @var boolean disable this element */
	public $Disabled;
	
	/** @var string name of the element used in request and to identify element in client side DOM */
	protected $Name;
	
	/** @var string value returned to/from the server */
	protected $Value;
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param boolean $disabled disable the element
	*/
	public function __construct(
		$name, 
		$disabled = false) 
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
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
	* Get value from request based on request method
	* @param string $requestMethod (Optional) GET or SET - defaults to HtmlSettings
	*/
	protected function GetUserValue($requestMethod = null)
	{
		$name = $this->GetName();
		if ($requestMethod == null) {
			$requestMethod = HtmlSettings::$RequestMethod;
		}
		if ($requestMethod == 'POST' && isset($_POST[$name])) {
			return htmlspecialchars_decode($_POST[$name]);
		} else if ($requestMethod == 'GET' && isset($_GET[$name])) {
			return htmlspecialchars_decode($_GET[$name]);
		}
		return null;
	}	
}

?>