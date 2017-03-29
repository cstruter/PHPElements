<?php

/**
* File Containing IPreRenderEvents Interface
*/

namespace CSTruter\Elements\Interfaces;

/**
* Post Render Events
* @package CSTruter\Elements\Interfaces
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
interface IPreRenderEvents
{
	/**
	* Raise Post Render Events
	*/
	function RaisePreRenderEvents();
}

?>