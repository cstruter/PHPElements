<?php

/**
* File Containing HtmlOptionGroupSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\HtmlOptionGroupElement;

/**
* Html optgroup element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/	
class HtmlOptionGroupSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var HtmlOptionGroupElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlOptionGroupElement associated element
	*/
	public function __construct(HtmlOptionGroupElement $element) {
		$this->element = $element;
	}
	
	/**
	* Get attributes used in outer html of element
	* @return array
	*/		
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->GetDisabled()) ? '' : null,
			'label' => $this->element->Label
		];
	}

	/**
	* Get html markup tag (optgroup element)
	* @return string
	*/		
	public function GetTagName() {
		return 'optgroup';
	}	
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return $this->element->GetChildren();
	}
}

?>