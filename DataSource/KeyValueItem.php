<?php

/**
* File Containing KeyValueItem Class
*/

namespace CSTruter\DataSource;

/**
* KeyValueItem class
* @package	CSTruter\DataSource
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class KeyValueItem
{
	/** @var mixed Key associated with the item */
	public $Key;
	
	/** @var mixed Value associated with this item */
	public $Value;
	
	/** @var mixed Original object passed to the item */
	public $Item;
	
	/**
	* Constructor
	* @param mixed $key Key associated with this item
	* @param mixed $value Value associated with this item
	* @param mixed $item Original object passed to the item
	*/
	public function __construct($key, $value, $item) {
		$this->Key = $key;
		$this->Value = $value;
		$this->Item = $item;
	}
}

?>