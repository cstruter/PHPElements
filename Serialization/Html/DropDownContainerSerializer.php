<?php

/**
* File Containing DropDownContainerSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Serialization\Interfaces\IHtmlScriptBlock,
	CSTruter\Elements\DropDownContainer;

/**
* DropDownContainer serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerSerializer 
implements IHtmlElement, IHtmlInnerElements, IHtmlScriptBlock
{
	/** @var DropDownContainer element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param DropDownContainer $element associated element
	*/
	public function __construct(DropDownContainer $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return string[]
	*/	
	public function GetAttributes() {
		return [
			'id' => $this->element->GetName(),
			'class' => 'cstruter-dropdown-container cstruter-unselectable'
		];
	}

	/**
	* Get html markup tag (div tag)
	* @return string
	*/	
	public function GetTagName() {
		return 'div';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return [
			$this->element->GetButton(),
			$this->element->GetContent()];
	}
	
	/**
	* Generate client side code that might be associated with an element
	* @return string javascript code
	*/	
	public function GetClientScriptBlock() {
		$name = $this->element->GetName();
		return "CSTruter.Elements.DropDownContainer('$name');".
				$this->element->OnButtonChanged.';';
	}
}

?>