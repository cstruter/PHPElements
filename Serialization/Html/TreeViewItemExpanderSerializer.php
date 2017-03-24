<?php

/**
* File Containing TreeViewItemExpanderSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Elements\TreeViewItemExpander,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements;

/**
* TreeView Expander element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItemExpanderSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var TreeViewItemExpander element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param TreeViewItemExpander associated element
	*/		
	public function __construct(TreeViewItemExpander $element) {
		$this->element = $element;
	}
	
	/**
	* Get the prefix needed to create distinct css classes for a rendering strategy
	* @return string prefix used in css classes
	*/
	private function getPrefix()
	{
		if (!empty($this->element->ParentElement->TreeViewElement->Strategy)) {
			return 'cstruter-tree-'.strtolower($this->element->ParentElement->TreeViewElement->Strategy);
		}
		return 'cstruter-tree';		
	}
	
	/**
	* Get attributes used in outer html of element
	* @return array
	*/		
	public function GetAttributes() {
		$prefix = $this->getPrefix();
		$attributes = [
			'data-value' => $this->element->ParentElement->Value
		];
		if ($this->element->ParentElement->Selected) {
			$attributes['class'] = "$prefix-selected";
		}
		return $attributes;
	}
	
	/**
	* Get html markup tag (span element)
	* @return string
	*/	
	public function GetTagName() {
		return 'span';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/		
	public function GetInnerElements() {
		return $this->element->ParentElement->Text;
	}
}

?>