<?php

/**
* File Containing HtmlElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Common\Exceptions\TypeException;

/**
* Base class used for all html elements
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
abstract class HtmlElement
{
	/** @var boolean disable this element */
	protected $Disabled = false;
	
	/** @var mixed the parent this element is embedded in */
	public $ParentElement = null;
	
	/**
	* Disabled Getter
	* @return boolean
	*/
	public function GetDisabled() {
		return $this->Disabled;
	}
	
	/**
	* Disabled Setter
	* @param boolean $value disable the element
	* @throws TypeException if a non boolean value was assigned to the value argument
	*/
	public function SetDisabled($value) {
		if (!is_bool($value)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Disabled = $value;
	}	
	
	/**
	* Render the element
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @return string
	*/
	public function Render(IHtmlSerializer $serializer = null) {
		if ($serializer == null) {
			$serializer = HtmlSettings::$Serializer;
		}
		return $serializer->Serialize($this);
	}
}

?>