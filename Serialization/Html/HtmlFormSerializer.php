<?php

/**
* File Containing HtmlFormSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Elements\HtmlFormElement;

/**
* Html form element serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlFormSerializer 
implements IHtmlElement
{
	/** @var HtmlFormElement element associated with this serialization strategy */
	protected $element;
	
	/**
	* Constructor
	* @param HtmlSelectElement $element associated element
	*/
	public function __construct(HtmlFormElement $element) {
		$this->element = $element;
	}

	/**
	* Get attributes used in outer html of element
	* @return array
	*/	
	public function GetAttributes() {
		return [
			'method' => $this->element->GetRequestMethod()
		];
	}

	/**
	* Get html markup tag (select tag)
	* @return string
	*/	
	public function GetTagName() {
		return 'form';
	}
}

?>