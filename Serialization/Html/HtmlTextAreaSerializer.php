<?php

/**
* File Containing HtmlTextAreaSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\HtmlTextAreaElement;

/**
* Html textarea element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlTextAreaSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var HtmlTextAreaElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlTextAreaElement associated element
	*/	
	public function __construct(HtmlTextAreaElement $element) {
		$this->element = $element;
	}
	
	/**
	* Get attributes used in outer html of element
	* @return array
	*/		
	public function GetAttributes() {
		$attributes = [
			'id' => $this->element->GetName(),
			'name' => $this->element->GetName(),
			'disabled' => ($this->element->GetDisabled()) ? '' : null
		];
		return $attributes;
	}
	
	/**
	* Get html markup tag (textarea element)
	* @return string
	*/		
	public function GetTagName() {
		return 'textarea';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return string
	*/	
	public function GetInnerElements() {
		return $this->element->GetValue();
	}	
}

?>