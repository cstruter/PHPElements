<?php

/**
* File Containing HtmlInputSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Elements\HtmlInputElement;

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
			'disabled' => ($this->element->Disabled) ? '' : null
		];
		if ($attributes['type'] !== 'password') {
			$attributes['value'] = $this->element->GetValue();
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