<?php

/**
* File Containing TreeViewItem Class
*/

namespace CSTruter\Elements;

/**
* Treeview item element - child element of Treeview element
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeViewItem extends HtmlElement
{
	/** @var boolean disable this element */
	public $Disabled;
	
	/** @var string value returned to/from the server */
	public $Value;
	
	/** @var string text displayed for the treeview item */
	public $Text;
	
	/** @var string the treeview item value assigned to the parent element */
	public $ParentValue;
	
	/** @var boolean indicates whether or not the element is selected */
	public $Selected = false;
	
	/** @var TreeViewItemExpander clickable expansion area*/
	public $ExpanderElement;
	
	/** @var TreeViewItemContainer child branch items */
	public $ContainerElement;
	
	/** @var The root element */
	public $TreeViewElement;
	
	/** @var string[] array of css classes */
	public $CSSClass = [];
	
	/** @var boolean the collapsed state of a node */
	public $Collapsed = true;
	
	/**
	* Constructor
	* @param string $value the value to be sent to the server if selected
	* @param string $text display text of the element
	* @param string $parentValue the value assigned to the parent element
	* @param boolean $selected indicates whether or not the element is selected
	* @param boolean $disabled the element will be unselectable if true
	*/
	public function __construct($value, $text, $parentValue = null, $selected = false, $disabled = false) 
	{
		$this->Text = $text;
		$this->Value = $value;
		$this->Selected = $selected;
		$this->ParentValue = $parentValue;
		$this->Disabled = $disabled;
		$this->ExpanderElement = new TreeViewItemExpander($this);
		$this->ContainerElement = new TreeViewItemContainer();
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