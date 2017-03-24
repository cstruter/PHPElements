<?php

/**
* File Containing IHtmlInnerElements Interface
*/

namespace CSTruter\Serialization\Interfaces;

/**
* Methods a serializer must implement to serialize its child elements
* @package CSTruter\Serialization\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IHtmlInnerElements
{
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/
	function GetInnerElements();
}

?>