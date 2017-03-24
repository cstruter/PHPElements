<?php

/**
* File Containing TreeViewItemExpander Class
*/

namespace CSTruter\Elements;

/**
* Treeview item expander element - child element of Treeview element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItemExpander extends HtmlElement
{
	/**
	* Constructor
	* @param TreeViewItem $element parent element wrapped by this element
	*/
	public function __construct(TreeViewItem $element) {
		$this->ParentElement = $element;
	}
}	
	
?>