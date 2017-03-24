<?php

/**
* File Containing HtmlSelectSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Serialization\Interfaces\IHtmlScriptBlock,
	CSTruter\Elements\HtmlSelectElement;

/**
* Html select element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlSelectSerializer 
implements IHtmlElement, IHtmlInnerElements, IHtmlScriptBlock
{
	/** @var HtmlSelectElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlSelectElement $element associated element
	*/
	public function __construct(HtmlSelectElement $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'id' => $this->element->GetName(),
			'name' => $this->element->GetName(),
			'disabled' => ($this->element->Disabled) ? '' : null
		];
	}

	/**
	* Get html markup tag (select tag)
	* @return string
	*/	
	public function GetTagName() {
		return 'select';
	}
	
	/**
	* Get child elements used to generate inner html
	* @return HtmlElement[]|string
	*/	
	public function GetInnerElements() {
		return $this->element->Children->Get();
	}
	
	/**
	* Generate client side code that might be associated with an element
	* @return string javascript code
	*/	
	public function GetClientScriptBlock() {
		$elementId = $this->element->GetName();
		$scriptBlock = '';
		if ($this->element->AutoPostBack) {
			$scriptBlock.="CSTruter.Elements.DropDownList('$elementId').AttachAutoPostBack();";
		}
		if ($this->element->OnClientChange !== null) {
			$changeListener = $this->element->OnClientChange;
			$scriptBlock.="CSTruter.Elements.DropDownList('$elementId').OnChange($changeListener);";
		}
		return $scriptBlock;
	}
}

?>