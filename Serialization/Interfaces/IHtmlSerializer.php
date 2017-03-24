<?php

/**
* File Containing IHtmlSerializer Interface
*/

namespace CSTruter\Serialization\Interfaces;

use CSTruter\Elements\HtmlElement;

/**
* Methods a main serializer needs to implement
* @package CSTruter\Serialization\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IHtmlSerializer {
	/**
	* Generate Html output for an element
	* @param HtmlElement $element Html element for rendering
	* @return string full outer and inner html
	*/
	function Serialize(HtmlElement $element);
}

?>