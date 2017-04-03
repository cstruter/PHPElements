<?php

/**
* File Containing DropDownContainerButtonSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\DropDownContainerButton;

/**
* DropDownContainerButton serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerButtonSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var DropDownContainerButton element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param DropDownContainerButton $element associated element
	*/
	public function __construct(DropDownContainerButton $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'class' => 'cstruter-dropdown-container-button'
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
			$this->element->GetText()];
	}
}

?>