<?php

/**
* File Containing HtmlButtonInputElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Elements\Interfaces\IPostRenderEvents;

/**
* Textbox input element 
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_input.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlButtonInputElement 
extends HtmlInputElement
implements IPostRenderEvents
{
	/** @var callable Callback fired when the user clicked the button */
	public $OnClick = null;
	
	/**
	* Constructor
	* @param string $name used to retrieve the element value from requests to the server and to identify the dom element client side
	* @param string $value (Optional) value displayed and sent from the element
	*/
	public function __construct($name, $value = null) {
		parent::__construct($name, 'submit', $value);
	}
	
	/**
	* Raise Post Render Events
	*/	
	public function RaisePostRenderEvents() {
		if ($this->OnClick === null) {
			return;
		}
		$name = $this->GetName();
		$userValue = $this->FormElement->GetUserValue($name);
		if ($userValue !== null) {
			$this->OnClick->__invoke($this->FormElement); 
		}		
	}
}

?>