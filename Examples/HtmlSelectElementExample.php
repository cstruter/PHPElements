<?php

include 'config.php';

use CSTruter\Elements\HtmlFormElement,
	CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement,
	CSTruter\Elements\HtmlOptionGroupElement,
	CSTruter\Elements\HtmlButtonInputElement;

$friends = [
	new HtmlOptionElement('Gerhardt Stander', 1),
	new HtmlOptionElement('Bertie Naude', 2),
	new HtmlOptionGroupElement('Family', [
		new HtmlOptionElement('Jurgens Truter', 3),
		new HtmlOptionElement('Marisa Truter', 4),
		new HtmlOptionElement('Maree Kleu', 5),
	])
];

$form = new HtmlFormElement('main', 'POST');

$control = new HtmlSelectElement('friends', $friends);
$control->SetForm($form);

$button = new HtmlButtonInputElement('btnSubmit', 'Go');
$button->OnClick = function(HtmlFormElement $form) {
	global $control;
	print $control->GetValue();
};
$button->SetForm($form);

include 'Views/ControlExample.html.php';

?>