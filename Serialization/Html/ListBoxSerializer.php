<?php

/**
* File Containing ListBoxSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Elements\ListBoxElement;

/**
* ListBox element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class ListBoxSerializer extends HtmlSelectSerializer 
{
	/**
	* Constructor
	* @param ListBoxElement $element associated element
	*/
	public function __construct(ListBoxElement $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'id' => $this->element->GetName(),
			'name' => $this->element->GetName().'[]',
			'multiple' => 'multiple',
			'disabled' => ($this->element->GetDisabled()) ? '' : null
		];
	}
}

?>