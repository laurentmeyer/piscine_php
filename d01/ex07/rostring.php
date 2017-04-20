#!/usr/bin/php
<?php
date_default_timezone_set(UTC);
ini_set('display_errors', 1);

function ft_split($str)
{
	$str = trim($str);
	while (strpos($str, "  "))
		$str = str_replace("  ", " ", $str);
	$array = explode(" ", $str);
	return $array;
}

if ($argc > 1)
{
	$array = ft_split($argv[1]);
	$first = array_shift($array);
	array_push($array, $first);
	$str = implode(" ", $array);
	if ($str != " ")
		echo $str;
	echo "\n";
}

?>
