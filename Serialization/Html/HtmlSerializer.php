<?php

/**
* File Containing HtmlSerializer Class
*/

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Serialization\Interfaces\IHtmlInnerElements,
	CSTruter\Serialization\Interfaces\IHtmlScriptBlock,
	CSTruter\Elements\HtmlElement,
	CSTruter\Elements\HtmlFormElement,
	CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement,
	CSTruter\Elements\HtmlOptionGroupElement,
	CSTruter\Elements\HtmlInputElement,
	CSTruter\Elements\CheckBox,
	CSTruter\Elements\CheckBoxList,
	CSTruter\Elements\TreeView,
	CSTruter\Elements\TreeViewItem,
	CSTruter\Elements\TreeViewItemExpander,
	CSTruter\Elements\TreeViewItemContainer,
	CSTruter\Elements\DropDownContainerButton,
	CSTruter\Elements\DropDownContainerContent,
	CSTruter\Elements\DropDownContainer;

/**
* Html serialization strategy
* @package CSTruter\Serialization\Html
* @author Christoff Trüter <christoff@cstruter.com>
* @copyright 2005-2017 CSTruter
*/
class HtmlSerializer
implements IHtmlSerializer
{	
	/**
	* Generate Html output for an element
	* @param HtmlElement $element Html element for rendering
	* @return string full outer and inner html
	*/
	public function Serialize(HtmlElement $element)
	{
		$serializer = $this->GetSerializer($element);
		
		if (!$serializer instanceof IHtmlElement) {
			throw new \Exception('Serializer '.get_class($serializer).' not instance of IHtmlElement');
		}
		
		$html = $this->BeginTag($serializer);
		if (!$this->isVoidElement($serializer)) {
			$html.= $this->getChildContent($serializer);
			$html.= $this->EndTag($serializer);
		}
		$html.= $this->GetChildScriptBlock($serializer);
		return $html;
	}
	
	/**
	* Get serializer associated to an element
	* @param HtmlElement $element Html element instance 
	* @return mixed
	*/
	public function GetSerializer($element) {
		if ($element instanceof HtmlSelectElement) {
			return new HtmlSelectSerializer($element);
		} else if ($element instanceof HtmlOptionElement) {
			return new HtmlOptionSerializer($element);
		}  else if ($element instanceof HtmlOptionGroupElement) {
			return new HtmlOptionGroupSerializer($element);
		} else if ($element instanceof HtmlInputElement) {
			return new HtmlInputSerializer($element);
		} else if ($element instanceof CheckBox) {
			return new CheckBoxSerializer($element);
		} else if ($element instanceof CheckBoxList) {
			return new CheckBoxListSerializer($element);
		} else if ($element instanceof TreeView) {
			return new TreeViewSerializer($element);
		} else if ($element instanceof TreeViewItem) {
			return new TreeViewItemSerializer($element);
		} else if ($element instanceof TreeViewItemExpander) {
			return new TreeViewItemExpanderSerializer($element);
		} else if ($element instanceof TreeViewItemContainer) {
			return new TreeViewItemContainerSerializer($element);
		} else if ($element instanceof HtmlFormElement) {
			return new HtmlFormSerializer($element);
		} else if ($element instanceof DropDownContainer) {
			return new DropDownContainerSerializer($element);
		} else if ($element instanceof DropDownContainerButton) {
			return new DropDownContainerButtonSerializer($element);
		} else if ($element instanceof DropDownContainerContent) {
			return new DropDownContainerContentSerializer($element);
		}
		throw new \Exception('No metadata found for element '.get_class($element));
	}
	
	/**
	* Get attributes for an element used in outer html
	* @param mixed $serializer Serialization strategy
	* @return string attribute markup
	*/
	protected function getAttributeHtml($serializer) {
		$html = '';
		$attributes = $serializer->GetAttributes();
		if ($attributes === null) {
			return $html;
		}
		foreach($attributes as $attribute => $value) {
			if ($value === '') {
				$html.=' '.strtolower($attribute);
			} else if ($value !== null) {
				$html.=' '.strtolower($attribute).'="'.htmlspecialchars($value).'"';
			}
		}
		return $html;
	}
	
	/**
	* Generate markup for inner html
	* @param mixed $serializer Serialization strategy
	* @return string inner html
	*/
	protected function getChildContent($serializer) {
		$html = '';
		if ($serializer instanceof IHtmlInnerElements) {
			$children = $serializer->GetInnerElements();
			if (!is_array($children)) {
				return $children;
			}
			foreach($children as $child) {
				$html.= ($child instanceof HtmlElement) 
					? $child->Render($this) 
					: $child;
			}
		}
		return $html;
	}

	/**
	* Render Begin Tag
	* @param mixed $serializer Serialization strategy
	* @return string
	*/
	public function BeginTag($serializer)
	{
		$tagName = $serializer->GetTagName();
		$html = "<$tagName";
		$html.= $this->getAttributeHtml($serializer);
		$html.= '>';
		return $html;
	}
	
	/**
	* Render End Tag
	* @param mixed $serializer Serialization strategy
	* @return string
	*/
	public function EndTag($serializer) 
	{
		$tagName = $serializer->GetTagName();
		return "</$tagName>";
	}	
	
	/**
	* Generate client side code that might be associated with an element
	* @param mixed $serializer Serialization strategy
	* @return string javascript code
	*/
	public function GetChildScriptBlock($serializer) {
		if ($serializer instanceof IHtmlScriptBlock) {
			$scriptBlock = $serializer->GetClientScriptBlock();
			return '<script type="text/javascript">'.$scriptBlock.'</script>';
		}
		return '';
	}
	
	/**
	* Checks if an element is a void element (no innerhtml)
	* @param mixed @serializer Serialization strategy
	* @return boolean
	*/
	protected function isVoidElement($serializer) {
		return !($serializer instanceof IHtmlInnerElements);
	}
}

?>