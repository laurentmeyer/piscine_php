#!/usr/bin/php
<?php

function ft_split($str)
{
	$str = trim($str);
	while (strpos($str, "  "))
		$str = str_replace("  ", " ", $str);
	$array = explode(" ", $str);
	sort($array);
	return $array;
}

array_shift($argv);
if (!empty($argv))
	foreach(ft_split(implode(" ", $argv)) as $elem)
			echo "$elem\n";

?>
