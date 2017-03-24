<?php

/**
* File Containing HtmlChildElements Class
*/

namespace CSTruter\Elements;

/**
* Collection of html elements
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlChildElements
{
	/** @var array an array of Html elements / text */
	protected $elements = [];
	
	/**
	* Constructor
	* @param array $elements (Optional) an array of Html elements / text
	*/
	public function __construct(array $elements = null) {
		if ($elements !== null) {
			$this->elements = $elements;
		}
	}
	
	/**
	* Returns a list of elements, if an index is supplied a single element matching that index will be returned
	* @param int|null $index (Optional) index of a specific element in the array
	* @return mixed
	*/
	public function Get($index = null) {
		if ($index === null) {
			return $this->elements;
		}
		return $this->elements[$index];
	}
	
	/**
	* Add an element to the collection
	* @param string|HtmlElement $element item to add to the list.
	*/
	public function Add($element) {
		$this->elements[] = $element;
	}
	
	/**
	* Add an element to the front of the collection
	* @param string|HtmlElement $element item to add to the list.
	*/
	public function Append($element) {
		array_unshift($this->elements, $element);
	}
	
	/**
	* Returns a count of how many items are added to the collection 
	* @return int
	*/
	public function Count() {
		return count($this->elements);
	}
}

?>