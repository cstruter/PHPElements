<?php

/**
* File Containing HtmlElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Serialization\Interfaces\IHtmlSerializer;

/**
* Base class used for all html elements
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
abstract class HtmlElement
{	
	/** @var mixed the parent this element is embedded in */
	public $ParentElement = null;
	
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