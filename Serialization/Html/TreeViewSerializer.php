<?php

/**
* File Containing TreeViewSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Serialization\Interfaces\IHtmlScriptBlock,
	CSTruter\Elements\TreeView;

/**
* TreeView serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewSerializer 
implements IHtmlElement, IHtmlInnerElements, IHtmlScriptBlock
{
	/** @var TreeView element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param TreeView associated element
	*/	
	public function __construct(TreeView $element) {
		$this->element = $element;
	}

	/**
	* Get the prefix needed to create distinct css classes for a rendering strategy
	* @return string prefix used in css classes
	*/
	private function getPrefix()
	{
		if (!empty($this->element->Strategy)) {
			return 'cstruter-tree-'.strtolower($this->element->Strategy);
		}
		return 'cstruter-tree';		
	}	
	
	/**
	* Get an array of css classes associated with this element
	* @return string[] array of css classes
	*/
	private function getCSS() {
		$prefix = $this->getPrefix();
		$CSSClasses = [$prefix, 'cstruter-unselectable'];
			
		if ($this->element->GetDisabled()) {
			$CSSClasses[] = "$prefix-disabled";
		}
		return array_merge($this->element->CSSClass, $CSSClasses);
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/		
	public function GetAttributes() {
		return [
			'id' => $this->element->GetName().'_tree',
			'class' => implode(' ', $this->getCSS())
		];
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
	
	/**
	* Generate client side code that is associated with this element
	* @return string javascript code
	*/	
	public function GetClientScriptBlock() {
		$strategy = $this->element->Strategy;
		$name = $this->element->GetName();
		$scriptBlock = "CSTruter.Elements.TreeView('$name', '$strategy').AttachTreeViewEvents();";
		if ($this->element->OnClientChange !== null) {
			$changeListener = $this->element->OnClientChange;
			$scriptBlock.="CSTruter.Elements.TreeView('$name', '$strategy').OnChange($changeListener);";
		}
		return $scriptBlock;
	}
}

?>