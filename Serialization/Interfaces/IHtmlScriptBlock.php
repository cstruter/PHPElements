<?php

/**
* File Containing IHtmlScriptBlock Interface
*/

namespace CSTruter\Serialization\Interfaces;

/**
* Methods a serializer must implement if it is providing some kind of javascript script block
* @package CSTruter\Serialization\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IHtmlScriptBlock
{
	/**
	* Generate client side code that might be associated with an element
	* @return string javascript code
	*/
	function GetClientScriptBlock();
}

?>