<?php

/**
* File Containing TreeViewItemSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\TreeViewItem,
	CSTruter\Elements\TreeView;

/**
* Treeview item serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItemSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var TreeViewItem element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param TreeViewItem associated element
	*/		
	public function __construct(TreeViewItem $element) {
		$this->element = $element;
	}

	/**
	* Get the prefix needed to create distinct css classes for a rendering strategy
	* @return string prefix used in css classes
	*/
	private function getPrefix()
	{
		if (!empty($this->element->TreeViewElement->Strategy)) {
			return 'cstruter-tree-'.strtolower($this->element->TreeViewElement->Strategy);
		}
		return 'cstruter-tree';		
	}
	
	/**
	* Get an array of css classes associated with this element
	* @return string[] array of css classes
	*/	
	private function getCSS()
	{
		$prefix = $this->getPrefix();
		list($firstElement, $lastElement) = $this->getBounds();
		$isFirst = ($firstElement == $this->element);
		$isLast = ($lastElement == $this->element);
		$hasChildren = ($this->element->ContainerElement->Children->Count() > 0);
		$CSSClasses = [];
		
		if ($isFirst && $isLast) {
			$CSSClasses[] = "$prefix-last";
		} else if ($isFirst) {
			$CSSClasses[] = "$prefix-first";
		} else if ($isLast) {
			$CSSClasses[] = "$prefix-last";
		}
		if ($hasChildren) {
			$CSSClasses[] = "$prefix-parent";
		}
		if ($this->element->GetCollapsed()) {
			$CSSClasses[] = "$prefix-collapsed";
		}
		if ($this->element->GetDisabled()) {
			$CSSClasses[] = "$prefix-item-disabled";
		}
		return array_merge($this->element->CSSClass, $CSSClasses);
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/		
	public function GetAttributes() {
		return [
			'class'=> implode(' ', $this->getCSS())
		];
	}

	/**
	* Get html markup tag (li element)
	* @return string
	*/	
	public function GetTagName() {
		return 'li';
	}	
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return [
			$this->element->ExpanderElement,
			$this->element->ContainerElement];
	}

	/**
	* Get the first and last element associated with the parent element
	* @return array
	*/		
	private function getBounds() {
		if ($this->element->ParentElement instanceof TreeView) {
			$children = $this->element->ParentElement->Children;
			$firstElement = $children->Get(1);
			$lastElement = $children->Get($children->Count() - 2);
		} else {
			$children = $this->element->ParentElement->ContainerElement->Children;
			$firstElement = $children->Get(0);
			$lastElement = $children->Get($children->Count() - 1);
		}
		return [$firstElement, $lastElement];
	}
}

?>