<?php

/**
* File Containing HtmlFormElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Elements\Exceptions\HtmlElementException,
	CSTruter\Elements\Interfaces\IPreRenderEvents,
	CSTruter\Elements\Interfaces\IHtmlFormControlElement;

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
	
	/** @var string Used to identify user interactions */
	protected $PostFieldElement;
	
	/** @var string|callable File include or Closure within the form tags */
	protected $OnBodyControlsAdded = null;
	
	/** @var string Filename for the view */
	protected $View = null;
	
	/** @var string name of the element used in request and to identify element in client side DOM */
	protected $Name;
	
	/**
	* Constructor
	* @param string $name used to identify the dom element client side	
	* @param string $requestMethod GET or POST methods
	*/
	public function __construct($name, $requestMethod) {
		$this->RequestMethod = $requestMethod;
		$this->Name = $name;
		$this->Children = new HtmlChildElements();
		$this->RequestVerification();
	}

	/**
	* RequestMethod getter
	* @return string
	*/
	public function GetRequestMethod() {
		return $this->RequestMethod;
	}
	
	/**
	* Name Getter
	* @return string
	*/
	public function GetName() {
		return $this->Name;
	}
	
	/**
	* Set Form Body
	* @param string $view File name for view include
	* @param callable $callback Closure fired when the view is created
	* @throws HtmlElementException if a view filename cannot be found
	*/
	public function Body($view, \Closure $callback) {
		if (!file_exists($view)) {
			throw new HtmlElementException("View $view not found", 10005);
		}
		$this->View = $view;
		$this->OnBodyControlsAdded = $callback;
	}
	
	/**
	* Get value from request based on request method
	* @param string $name element request object property name
	* @return string|string[]
	*/
	public function GetUserValue($name)
	{
		$value = null;
		if ($this->RequestMethod == 'POST' && isset($_POST[$name])) {
			$value = $_POST[$name];
		} else if ($this->RequestMethod == 'GET' && isset($_GET[$name])) {
			$value = $_GET[$name];
		}
		if ($value !== null) {
			if (is_array($value)) {
				return array_map(function($value) { 
					return htmlspecialchars_decode($value); 
				}, $value);
			}
			return htmlspecialchars_decode($value);
		}
		return $value;
	}
	
	/**
	* Check if the user performed an interaction on the form
	* @param string $name element request object property name
	*/	
	public function IsPostBack() {
		$sessionKey = $this->GetRequestVerificationKey();
		return (isset($_POST[$sessionKey]));
	}
	
	/**
	* Renders fileName set via Body method
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @throws HtmlElementException if no child elements were added
	*/
	public function Render(IHtmlSerializer $serializer = null) { 
		if ($this->OnBodyControlsAdded === null) {
			throw new HtmlElementException('No elements assigned to this form', 10001);
		}	
		$html= $this->BeginTag($serializer);
		$html.= $this->GetCallbackContents($serializer);
		$html.= $this->EndTag($serializer);
		return $html;
	}

	/**
	* Rudimentary Request Verification
	* @throws HtmlElementException if the server is unable to verify the request
	*/
	protected function RequestVerification() {
		$sessionKey = $this->GetRequestVerificationKey();
		$sessionValue = $this->GetUserValue($sessionKey);
		if ($sessionValue !== null) {
			if (isset($_SESSION[$sessionKey])) {
				if ($_SESSION[$sessionKey] !== $sessionValue) {
					throw new HtmlElementException('Request verification failed', 10011);
				}
			} else {
				throw new HtmlElementException('Unable to verify request', 10012);
			}
		}
		$sessionValue = uniqid();
		$this->PostFieldElement = new HtmlHiddenInputElement($sessionKey, $sessionValue);
		$_SESSION[$sessionKey] = $sessionValue;		
	}	
	
	/**
	* Get Request Verification Key
	* @return string
	*/
	protected function GetRequestVerificationKey() {
		return $this->GetName().'_IsPostBack';
	}
	
	/**
	* Get contents of the Body method supplied fileName
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @throws HtmlElementException if no child elements were added
	* @return string
	*/
	protected function GetCallbackContents(IHtmlSerializer $serializer = null) {
		$children = $this->OnBodyControlsAdded->__invoke($this);
		if ($children === null) {
			throw new HtmlElementException('No elements assigned to this form', 10002);
		}
		foreach($children as $child) {
			if ($child instanceof IHtmlFormControlElement) {
				$child->SetForm($this);
			}
		}
		foreach($children as $child) {
			if ($child instanceof IPreRenderEvents) {
				$child->RaisePreRenderEvents();
			}
			$var = $child->GetName();
			$$var = $child;
		}
		ob_start();
		include $this->View;
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}

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
		$html = $this->PostFieldElement->Render($serializer);
		$html.= $serializer->EndTag($strategy);	
		return $html;
	}
}

?>