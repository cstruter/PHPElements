<?php

include 'config.php';

use CSTruter\Elements\HtmlFormElement,
	CSTruter\Elements\TreeView,
	CSTruter\Elements\TreeViewItem,
	CSTruter\Elements\HtmlButtonInputElement;

$technologies = [
	new TreeViewItem(10, 'LinQ', 2),
	new TreeViewItem(1, 'Microsoft'),
	new TreeViewItem(2, 'C#', 1),
	new TreeViewItem(3, 'VB.net', 1),
	new TreeViewItem(4, 'Open Source'),
	new TreeViewItem(5, 'Python', 4),
	new TreeViewItem(6, 'Ruby', 4),
	new TreeViewItem(7, 'PHP', 4),
	new TreeViewItem(8, 'Perl', 4),
	new TreeViewItem(9, 'Java', 4),
	new TreeViewItem(11, '5.2', 7),
	new TreeViewItem(12, '4.4', 7),
	new TreeViewItem(13, '1.x', 8)
];

$form = new HtmlFormElement('POST');

$tree = new TreeView('technologies', $technologies);
$tree->SetForm($form);

$button = new HtmlButtonInputElement('btnSubmit', 'Go');
$button->OnClick = function(HtmlFormElement $form) {
	global $tree;
	print $tree->GetValue();
};
$button->SetForm($form);

include 'Views/TreeViewExample.html.php';

?>