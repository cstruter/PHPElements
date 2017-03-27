<?php

/**
* File Containing HtmlSettings Class and settings
*/

namespace CSTruter\Elements;

use CSTruter\Serialization\Html\HtmlSerializer;

/**
* Html configuration class
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlSettings
{
	/** @var IHtmlSerializer Default Serializer used among all html elements */
	public static $Serializer;
}

HtmlSettings::$Serializer = new HtmlSerializer();

?>