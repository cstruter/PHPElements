<?php

/**
* File Containing TreeView Class
*/

namespace CSTruter\Elements;

/**
* Treeview element - used to display hierarchal data
* @package	CSTruter\Elements
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class TreeView extends HtmlFormControlElement
{
	/** @var HtmlHiddenInputElement form element used to send data to and from the server */
	private $formField = null;
	
	/** @var string a client side callback that will be fired when the selected option changes */
	public $OnClientChange = null;
	
	/** @var HtmlChildElements inner / child elements */
	public $Children;
	
	/** @var string[] array of css classes */
	public $CSSClass = [];
	
	/** @var string which rendering strategy to use, e.g. "Responsive" */
	public $Strategy = null ;
	
	/**
	* Constructor
	* @param string $name name of the element 
	* @param TreeViewItem[] $children array of treeview items
	* @param string $value (Optional) selected value
	*/
	public function __construct($name, array $children = [], $value = null)
	{
		parent::__construct($name);
		$this->formField = new HtmlHiddenInputElement($name, $value);
		$this->SetChildren($children, $this->formField->GetValue());
	}
	
	/**
	* Value Setter - Set the selected value of the treeview
	* @param string $value selected value
	*/
	public function SetValue($value) {
		$this->Value = null;
		$this->setValueRecursive($this, $value);
		if ($this->Value !== null) {
			$this->Expand($this->Value);
		}
		$this->formField->SetValue($value);
	}
	
	/**
	* Expand treeview item and all its parents
	* @param TreeViewItem $item 
	*/
	public function Expand(TreeViewItem $item) {
		$item->Collapsed = false;
		if ($item->ParentElement instanceof TreeViewItem) {
			$this->Expand($item->ParentElement);
		}
	}
	
	/**
	* Add a list of treeview items to the treeview
	* @param TreeViewItem[] $children
	* @param string $value
	*/
	public function SetChildren(array $children, $value = null)
	{
		$this->Children = new HtmlChildElements();
		$this->setChildrenRecursive($this, null, $children, $value);
		if ($this->Value !== null) {
			$this->Expand($this->Value);
		}
		$this->formField->SetValue($value);
		$this->Children->Add($this->formField);
	}
	
	/**
	* Recursively add treeview items to the treeview - building a hierarchal collection
	* @param TreeView|TreeViewItem $parentElement
	* @param string $parentValue
	* @param HtmlChildElements $children
	* @param string $value
	*/
	private function setChildrenRecursive($parentElement, $parentValue, $children, $value) {
		foreach($children as $child) {
			if ($child instanceof TreeViewItem) {
				$child->TreeViewElement = $this;
				if ($child->ParentValue === $parentValue) {
					$child->ParentElement = $parentElement;
					$parentChildren = $this->getChildren($parentElement);
					$parentChildren->Add($child);
					$this->setChildrenRecursive($child, $child->Value, $children, $value);
				}
				$child->Selected = false;
				if ($child->Value == $value) {
					$child->Selected = true;
					$this->Value = $child;
				}
			} else {
				throw new Exception("Values of TreeViewItem expected for $this->Name");
			}
		}
	}
	
	/**
	* Set selected value recursively
	* @param TreeViewItem $element
	* @param string $value
	*/
	private function setValueRecursive($element, $value) {
		$children = $this->getChildren($element)->Get();
		foreach($children as $child) {
			if ($child instanceof TreeViewItem) {
				$child->Collapsed = true;
				$child->Selected = false;
				if ($child->Value == $value) {
					$this->Value = $child;
					$child->Selected = true;
				}
				if ($child->ContainerElement->Children->Count() > 0) {
					$this->setValueRecursive($child, $value);
				}
			}
		}
	}
	
	/**
	* Get a list of child elements
	* @param TreeView|TreeViewItem $element
	* @return HtmlChildElements
	*/
	private function getChildren($element) {
		return ($element instanceof TreeView) 
			? $element->Children 
			: $element->ContainerElement->Children;
	}
}

?>