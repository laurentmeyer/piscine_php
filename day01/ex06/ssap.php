#!/usr/bin/php
<?php

function ft_split($str)
{
	$array = preg_split("/ +/", $str, -1, PREG_SPLIT_NO_EMPTY);
	sort($array);
	return $array;
}

array_shift($argv);
if (!empty($argv))
	foreach(ft_split(implode(" ", $argv)) as $elem)
			echo "$elem\n";

?>
