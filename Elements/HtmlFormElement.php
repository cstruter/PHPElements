<?php

/**
* File Containing HtmlFormControlElement Class
*/

namespace CSTruter\Elements;

/**
* Form Element
* @package	CSTruter\Elements
* @see 		https://www.w3schools.com/tags/tag_form.asp
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlFormElement extends HtmlElement
{
	/** @var HtmlChildElements inner / child elements */
	public $Children;
	
	/** @var string GET or POST */
	protected $RequestMethod;
	
	/**
	* RequestMethod getter
	* @return string
	*/
	public function GetRequestMethod() {
		return $this->RequestMethod;
	}
	
	/**
	* Constructor
	* @param string $requestMethod GET or POST methods
	*/
	public function __construct($requestMethod) {
		$this->RequestMethod = $requestMethod;
		$this->Children = new HtmlChildElements();
	}
	
	/**
	* Get value from request based on request method
	* @param string $name element request object property name
	*/
	public function GetUserValue($name)
	{
		if ($this->RequestMethod == 'POST' && isset($_POST[$name])) {
			return htmlspecialchars_decode($_POST[$name]);
		} else if ($this->RequestMethod == 'GET' && isset($_GET[$name])) {
			return htmlspecialchars_decode($_GET[$name]);
		}
		return null;
	}
	
	/**
	* Not Implemented - Rather use BeginTag and EndTag
	* @param IHtmlSerializer|null $serializer serialization strategy
	*/
	public function Render(IHtmlSerializer $serializer = null) { }

	/**
	* Render the element
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @return string
	*/	
	public function BeginTag(IHtmlSerializer $serializer = null) 
	{
		if ($serializer == null) {
			$serializer = HtmlSettings::$Serializer;
		}
		$strategy = $serializer->GetSerializer($this);
		return $serializer->BeginTag($strategy);
	}
	
	/**
	* Render the element
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @return string
	*/	
	public function EndTag(IHtmlSerializer $serializer = null) 
	{
		if ($serializer == null) {
			$serializer = HtmlSettings::$Serializer;
		}
		$strategy = $serializer->GetSerializer($this);
		return $serializer->EndTag($strategy);		
	}
}

?>