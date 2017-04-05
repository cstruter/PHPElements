<?php

/**
* File Containing HtmlInputSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Elements\HtmlInputElement,
	CSTruter\Elements\HtmlCheckBoxInputElement,
	CSTruter\Elements\HtmlPasswordInputElement,
	CSTruter\Elements\HtmlRadioBoxInputElement;

/**
* Html input element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlInputSerializer 
implements IHtmlElement
{
	/** @var HtmlInputElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlInputElement associated element
	*/	
	public function __construct(HtmlInputElement $element) {
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
			'type' => $this->element->GetType(),
			'disabled' => ($this->element->GetDisabled()) ? '' : null
		];
		if (!$this->element instanceof HtmlPasswordInputElement) {
			$attributes['value'] = $this->element->GetValue();
		}
		if ($this->element instanceof HtmlRadioBoxInputElement) {
			$name = $this->element->GetGroupName();
			if ($name !== null) {
				$attributes['name'] = $name;
			}
		}
		if ($this->element instanceof HtmlCheckBoxInputElement) {
			if ($this->element->GetChecked()) {
				$attributes['checked'] = 'checked';
			}
		}
		return $attributes;
	}
	
	/**
	* Get html markup tag (input element)
	* @return string
	*/	
	public function GetTagName() {
		return 'input';
	}
}

?>