<?php

/**
* File Containing TreeViewItemContainer Class
*/

namespace CSTruter\Elements;

/**
* Treeview item container element - child element of Treeview item element, contains a list of tree view items
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItemContainer extends HtmlElement
{
	/** @var HtmlChildElements inner / child elements */
	public $Children;

	/**
	* Constructor
	*/
	public function __construct() {
		$this->Children = new HtmlChildElements();
	}

	/**
	* Render the element
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @return string
	*/
	public function Render($serializer = null) {
		if ($this->Children->Count() > 0) 
			return parent::Render($serializer);
		return null;
	}
}

?>