<?php

/**
* File Containing DropDownContainerContentSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\DropDownContainerContent;

/**
* DropDownContainerContent serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class DropDownContainerContentSerializer
implements IHtmlElement, IHtmlInnerElements
{
	/** @var DropDownContainerContent element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param DropDownContainerContent $element associated element
	*/
	public function __construct(DropDownContainerContent $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'class' => 'cstruter-dropdown-container-content'
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
			$this->element->GetElement()];
	}
}

?>