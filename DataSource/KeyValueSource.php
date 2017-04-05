<?php

/**
* File Containing KeyValueSource Class
*/

namespace CSTruter\DataSource;

/**
* KeyValueSource class
* @package	CSTruter\DataSource
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class KeyValueSource
{
	/** @var string Mapped field key within the passed array */
	protected $KeyField;
	
	/** @var string Mapped field value within the passed array */
	protected $ValueField;
	
	/** @var mixed[] list of items to be transformed */
	protected $Items;
	
	/**
	* Constructor
	* @param string $keyField 
	* @param string $valueField
	* @param array $items
	*/
	public function __construct($keyField, $valueField, $items) {
		$this->KeyField = $keyField;
		$this->ValueField = $valueField;
		$this->Items = $items;
	}
	
	/**
	* Returns a list of KeyValue Items
	* @return KeyValueItem[]
	*/
	public function GetSource() {
		$total = count($this->Items);
		for($i = 0; $i < $total; $i++) {
			$item = $this->Items[$i];
			$key = $item[$this->KeyField];
			$value = $item[$this->ValueField];
			yield new KeyValueItem($key, $value, $item);
		}
	}
}

?>