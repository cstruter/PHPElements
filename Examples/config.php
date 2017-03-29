<?php
session_start();

function __autoload($class) {
	require '../../'.str_replace('\\', '/', $class).'.php';
}

?>