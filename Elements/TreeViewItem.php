<?php

/**
* File Containing TreeViewItem Class
*/

namespace CSTruter\Elements;

use CSTruter\Common\Exceptions\TypeException;

/**
* Treeview item element - child element of Treeview element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItem extends HtmlElement
{	
	/** @var string value returned to/from the server */
	public $Value;
	
	/** @var string text displayed for the treeview item */
	public $Text;
	
	/** @var string the treeview item value assigned to the parent element */
	public $ParentValue;
	
	/** @var boolean indicates whether or not the element is selected */
	protected $Selected = false;
	
	/** @var TreeViewItemExpander clickable expansion area*/
	public $ExpanderElement;
	
	/** @var TreeViewItemContainer child branch items */
	public $ContainerElement;
	
	/** @var The root element */
	public $TreeViewElement;
	
	/** @var string[] array of css classes */
	public $CSSClass = [];
	
	/** @var boolean the collapsed state of a node */
	protected $Collapsed = true;
	
	/**
	* Constructor
	* @param string $value the value to be sent to the server if selected
	* @param string $text display text of the element
	* @param string $parentValue the value assigned to the parent element
	* @param boolean $selected indicates whether or not the element is selected
	* @throws TypeException if non boolean value was assigned to the selected argument
	*/
	public function __construct($value, $text, $parentValue = null, $selected = false) 
	{
		if (!is_bool($selected)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Text = $text;
		$this->Value = $value;
		$this->Selected = $selected;
		$this->ParentValue = $parentValue;
		$this->ExpanderElement = new TreeViewItemExpander($this);
		$this->ContainerElement = new TreeViewItemContainer();
	}
	
	/**
	* Selected Getter
	* @return boolean
	*/
	public function GetSelected() {
		return $this->Selected;
	}
	
	/**
	* Selected Setter
	* @param boolean $value is selected
	* @throws TypeException if a non boolean value was assigned to the value argument
	*/
	public function SetSelected($value) {
		if (!is_bool($value)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Selected = $value;
	}

	/**
	* Collapsed Getter
	* @return boolean
	*/
	public function GetCollapsed() {
		return $this->Collapsed;
	}
	
	/**
	* Collapsed Setter
	* @param boolean $value is selected
	* @throws TypeException if a non boolean value was assigned to the value argument
	*/
	public function SetCollapsed($value) {
		if (!is_bool($value)) {
			throw new TypeException('Type bool expected', 1);
		}
		$this->Collapsed = $value;
	}	
	
	/**
	* Returns the value assigned to this treeview item
	* @return string 
	*/
	public function __toString() {
        return (string)$this->Value;
    }
}

?>