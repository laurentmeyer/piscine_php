#!/usr/bin/php
<?php

if ($argc > 1)
{
	$array = preg_split("/ +/", $argv[1], -1, PREG_SPLIT_NO_EMPTY);
	$first = array_shift($array);
	array_push($array, $first);
	$str = implode(" ", $array);
	if ($str != " ")
		echo $str;
	echo "\n";
}

?>
