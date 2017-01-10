#!/usr/bin/php
<?php

if ($argc > 1)
{
	$array = preg_split("/ +/", $argv[1]);
	$first = array_shift($array);
	array_push($array, $first);
	$str = implode(" ", $array);
	echo "$str\n";
}
