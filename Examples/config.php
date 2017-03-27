<?php

function __autoload($class) {
	require '../../'.str_replace('\\', '/', $class).'.php';
}

?>