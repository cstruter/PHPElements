<?php

/**
* File Containing IHtmlElement Interface
*/

namespace CSTruter\Serialization\Interfaces;

/**
* Basic methods a serializer must implement in order to render html elements
* @package CSTruter\Serialization\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IHtmlElement
{
	/**
	* Get attributes used in outer html of element
	* @return array
	*/
	function GetAttributes();
	
	/**
	* Get html markup tag
	* @return string
	*/
	function GetTagName();
}

?>