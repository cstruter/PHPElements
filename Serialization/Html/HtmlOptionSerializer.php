<?php

/**
* File Containing HtmlOptionSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\HtmlOptionElement;

/**
* Html option element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlOptionSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var HtmlOptionElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlOptionElement associated element
	*/
	public function __construct(HtmlOptionElement $element) {
		$this->element = $element;
	}
	
	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? '' : null,
			'selected' => ($this->element->Selected) ? '' : null,
			'value' => $this->element->Value
		];
	}

	/**
	* Get html markup tag (option element)
	* @return string
	*/	
	public function GetTagName() {
		return 'option';
	}	
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return $this->element->Text;
	}
}

?>