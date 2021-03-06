<?php

/**
* File Containing CheckBoxListSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Elements\CheckBoxList;

/**
* CheckBox List serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class CheckBoxListSerializer 
implements IHtmlElement, IHtmlInnerElements
{
	/** @var CheckBoxList element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param CheckBoxList $element associated element
	*/
	public function __construct(CheckBoxList $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'class' => 'cstruter-checkboxlist'];
	}

	/**
	* Get html markup tag (select tag)
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
		return $this->element->Children->Get();
	}
}

?>