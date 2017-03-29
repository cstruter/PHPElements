<?php

/**
* File Containing CheckBoxSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\CheckBox;

/**
* Checkbox serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class CheckBoxSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var CheckBox element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param CheckBox $element associated element
	*/
	public function __construct(CheckBox $element) {
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
	* Get html markup tag (select tag)
	* @return string
	*/	
	public function GetTagName() {
		return 'label';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return [
			$this->element->FormFieldElement,
			$this->element->GetLabel()];
	}
}

?>