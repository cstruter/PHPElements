<?php

/**
* File Containing TreeViewItemContainerSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Elements\TreeViewItemContainer,
	CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements;

/**
* TreeView Container element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItemContainerSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var TreeViewItemContainer element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param TreeViewItemContainer associated element
	*/	
	public function __construct(TreeViewItemContainer $element) {
		$this->element = $element;
	}
	
	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return null;
	}
	
	/**
	* Get html markup tag (ul element)
	* @return string
	*/		
	public function GetTagName() {
		return 'ul';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return $this->element->Children->Get();
	}
}

?>