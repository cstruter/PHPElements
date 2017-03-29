<?php

/**
* File Containing HtmlPageElement Class
*/

namespace CSTruter\Elements;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Elements\Exceptions\HtmlElementException;

/**
* Html Page Element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlPageElement
{
	/** @var string Page Title */
	public $Title = 'Untitled Page';
	
	/** @var string|callable File include or Closure within the form tags */
	protected $OnBodyControlsAdded = null;
	
	/** @var string Filename for the view */
	protected $View = null;
	
	/**
	* Constructor
	*/
	public function __construct() {
		$this->Children = new HtmlChildElements();
	}	
	
	/**
	* Set Page Body
	* @param string $view File name for view include
	* @param callable $callback Closure fired when the view is created
	* @throws HtmlElementException if view filename not found
	*/
	public function Body($view, \Closure $callback) {
		if (!file_exists($view)) {
			throw new HtmlElementException("View $view not found", 10006);
		}
		$this->View = $view;
		$this->OnBodyControlsAdded = $callback;
	}
	
	/**
	* Render the page
	* @param IHtmlSerializer|null $serializer serialization strategy
	* @throws HtmlElementException if no elements were added to this class
	* @return string
	*/	
	public function Render(IHtmlSerializer $serializer = null) {
		if ($this->OnBodyControlsAdded === null) {
			throw new HtmlElementException('No elements assigned to this page', 10003);
		}
		$children = $this->OnBodyControlsAdded->__invoke($this);
		if ($children === null) {
			throw new HtmlElementException('No elements assigned to this page', 10004);
		}
		$this->Children = new HtmlChildElements($children);
		$page = $this;
		foreach($children as $child) {
			$var = $child->GetName();
			$$var = $child;
		}
		ob_start();
		include $this->View;
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}

?>