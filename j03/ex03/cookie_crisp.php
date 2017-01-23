<?php

$action = $_GET['action'];
$name = $_GET['name'];
$value = $_COOKIE[$name];

if ($action == "set" && $name != NULL)
	setcookie($name, $_GET['value'], time() + (30 * 24 * 60 * 60));
if ($action == "get" && $value != NULL)
	echo "$value\n";
if ($action == "del" && $name != NULL)
	setcookie($name, "", time() - (60 * 60));

?>
